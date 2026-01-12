#!/bin/bash
# generate.sh - Generator Blueprint Otomatis untuk Astro Project
set -euo pipefail

OUT="draft.md"
ROOT="."

# Pola eksklusi disesuaikan dengan struktur Astro project
EXCLUDE_PATTERNS=( 
  "./.git/*" 
  "./.astro/*" 
  "./.yarn/*" 
  "./.json/*" 
  "./.vscode/*" 
  "./.gitignore"
  "./.env"
  "./.gitattributes"
  "./.yarnrc.yml"
  "./.DS_Store"
  "./node_modules/*" 
  "./dist/*"
  "./public/images/*"
  "./public/videos/*"
  "./public/icons/*"
  "./public/api/lib/*"
  "./package-lock.json" 
  "./pnpm-lock.yaml"
  "./bun.lockb"
  "./yarn.lock"
  "./.prettierrc"
  "./.markdownlint.json"
  "./README.mdx"
  "./README.md"
  "./readme.mdx"
  "./readme.md"
  "./LICENSE"
  "./$OUT" 
  "./config/nginx/*"
  # Eksklusi file media
  "*.png" "*.jpg" "*.jpeg" "*.webp" "*.ico" "*.gif" "*.svg" "*.avif"
  "*.woff" "*.woff2" "*.ttf" "*.otf" "*.eot"
  "*.mp3" "*.mp4" "*.wav" "*.avi"
  "*.db" "*.csv" "*.sh"
)

# Fungsi untuk menentukan bahasa berdasarkan ekstensi file
lang_for_ext() {
  case "$1" in
    astro)      printf "astro" ;;
    tsx)        printf "tsx" ;;
    ts)         printf "typescript" ;;
    mjs)        printf "javascript" ;;
    cjs)        printf "javascript" ;;
    js)         printf "javascript" ;;
    jsx)        printf "jsx" ;;
    json)       printf "json" ;;
    md)         printf "markdown" ;;
    mdx)        printf "markdown" ;;
    html)       printf "html" ;;
    css)        printf "css" ;;
    scss)       printf "scss" ;;
    txt)        printf "text" ;;
    yml|yaml)   printf "yaml" ;;
    sh)         printf "bash" ;;
    conf)       printf "nginx" ;;
    Dockerfile) printf "dockerfile" ;;
    Makefile)   printf "makefile" ;;
    *)          printf "" ;;
  esac
}

# Fungsi untuk menghitung jumlah backticks maksimal dalam file
count_max_backticks() {
  local file="$1"
  local max=3
  
  while IFS= read -r line; do
    if [[ "$line" =~ ^[[:space:]]*(\`+) ]]; then
      local count=${#BASH_REMATCH[1]}
      if [ "$count" -ge "$max" ]; then
        max=$((count + 1))
      fi
    fi
  done < "$file"
  
  echo "$max"
}

# Inisialisasi file output
: > "$OUT"

# Kumpulkan semua file
files=()
while IFS= read -r -d '' f; do
  skip=false
  for pat in "${EXCLUDE_PATTERNS[@]}"; do
    if [[ "$f" == $pat ]]; then
      skip=true
      break
    fi
  done
  $skip && continue
  files+=("$f")
done < <(find "$ROOT" -type f -print0)

if [ "${#files[@]}" -eq 0 ]; then
  echo "Tidak ada file ditemukan untuk diproses."
  exit 0
fi

# Kelompokkan file berdasarkan direktori utama
declare -A groups
for f in "${files[@]}"; do
  p="${f#./}"
  if [[ "$p" == */* ]]; then
    top="${p%%/*}"
  else
    top="ROOT"
  fi
  rel="./${p}"
  if [ -z "${groups[$top]:-}" ]; then
    groups[$top]="$rel"
  else
    groups[$top]="${groups[$top]}"$'\n'"$rel"
  fi
done

# Urutan prioritas direktori untuk Astro project
priority_dirs=("src" "public" "config" "scripts" "ROOT")
processed_dirs=()

# Proses direktori berdasarkan prioritas
for priority in "${priority_dirs[@]}"; do
  if [ -n "${groups[$priority]:-}" ]; then
    printf "## Direktori: %s\n\n" "$priority" >> "$OUT"
    
    mapfile -t flist < <(printf '%s\n' "${groups[$priority]}" | sort -V)
    
    for file in "${flist[@]}"; do
      case "$file" in
        "./$OUT" | "$OUT" | "./generate.sh" | "generate.sh") continue ;;
      esac
      
      filename="$(basename -- "$file")"
      if [[ "$filename" == *.* ]]; then
        ext="${filename##*.}"
      else
        ext="$filename"
      fi
      
      lang="$(lang_for_ext "$ext")"
      
      printf "### File: \`%s\`\n\n" "$file" >> "$OUT"
      
      # Hitung jumlah backticks yang dibutuhkan
      backtick_count=$(count_max_backticks "$file")
      backticks=$(printf '`%.0s' $(seq 1 "$backtick_count"))
      
      if [ -n "$lang" ]; then
        printf '%s%s\n' "$backticks" "$lang" >> "$OUT"
      else
        printf '%s\n' "$backticks" >> "$OUT"
      fi
      
      sed 's/\r$//' "$file" >> "$OUT"
      printf '\n%s\n\n---\n\n' "$backticks" >> "$OUT"
    done
    
    processed_dirs+=("$priority")
  fi
done

# Proses direktori lainnya yang tidak ada dalam prioritas
IFS=$'\n'
for top in $(printf '%s\n' "${!groups[@]}" | sort -V); do
  # Skip jika sudah diproses
  skip=false
  for pd in "${processed_dirs[@]}"; do
    if [ "$top" == "$pd" ]; then
      skip=true
      break
    fi
  done
  $skip && continue
  
  printf "## Direktori: %s\n\n" "$top" >> "$OUT"
  
  mapfile -t flist < <(printf '%s\n' "${groups[$top]}" | sort -V)
  
  for file in "${flist[@]}"; do
    case "$file" in
      "./$OUT" | "$OUT" | "./generate.sh" | "generate.sh") continue ;;
    esac
    
    filename="$(basename -- "$file")"
    if [[ "$filename" == *.* ]]; then
      ext="${filename##*.}"
    else
      ext="$filename"
    fi
    
    lang="$(lang_for_ext "$ext")"
    
    printf "### File: \`%s\`\n\n" "$file" >> "$OUT"
    
    # Hitung jumlah backticks yang dibutuhkan
    backtick_count=$(count_max_backticks "$file")
    backticks=$(printf '`%.0s' $(seq 1 "$backtick_count"))
    
    if [ -n "$lang" ]; then
      printf '%s%s\n' "$backticks" "$lang" >> "$OUT"
    else
      printf '%s\n' "$backticks" >> "$OUT"
    fi
    
    sed 's/\r$//' "$file" >> "$OUT"
    printf '\n%s\n\n---\n\n' "$backticks" >> "$OUT"
  done
done

echo "Selesai! File '$OUT' telah dibuat (Mode: Astro Project)"
echo "Direktori yang diproses: ${#groups[@]}"
echo "Total file: ${#files[@]}"