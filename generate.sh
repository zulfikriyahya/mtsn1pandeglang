#!/bin/bash
# generate.sh - Generator Blueprint Otomatis untuk Astro Project
set -euo pipefail

OUT="draft.md"
ROOT="."

EXCLUDE_PATTERNS=(
  "./.git/*"
  "./.astro/*"
  "./.yarn/*"
  "./.json/*"
  "./.vscode/*"
  "./.gitignore"
  "./.env"
  "./todo.md"
  "./.gitattributes"
  "./.yarnrc.yml"
  "./.DS_Store"
  "./node_modules/*"
  "./dist/*"
  "./public/images/*"
  "./public/videos/*"
  "./public/icons/*"
  "./public/api/lib/*"
  "./public/manifest.json"
  "./public/robots.txt"
  "./public/template.mdx"
  "./package-lock.json"
  "./pnpm-lock.yaml"
  "./.prettierrc"
  "./.markdownlint.json"
  "./LICENSE"
  "./README.mdx"
  "./skills.md"
  "./install.sh"
  "./dummy.sh"
  "./dummy-pengaduan.sh"
  "./deploy.sh"
  "./rebuild.sh"
  "./generate.sh"
  "./$OUT"
  "./config/nginx/*"
  # Konten artikel/halaman (tidak relevan untuk blueprint teknis)
  "./src/content/*"
  # Media & font
  "*.png" "*.jpg" "*.jpeg" "*.webp" "*.ico" "*.gif" "*.svg" "*.avif"
  "*.woff" "*.woff2" "*.ttf" "*.otf" "*.eot"
  "*.mp3" "*.mp4" "*.wav" "*.avi"
  "*.db" "*.csv" "*.htaccess"
  # Markup content (bukan code)
  "*.md" "*.mdx" "*.txt" "*.lock"
)

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
    html)       printf "html" ;;
    css)        printf "css" ;;
    scss)       printf "scss" ;;
    yml|yaml)   printf "yaml" ;;
    sh)         printf "bash" ;;
    conf)       printf "nginx" ;;
    php)        printf "php" ;;
    Dockerfile) printf "dockerfile" ;;
    Makefile)   printf "makefile" ;;
    *)          printf "" ;;
  esac
}

count_max_backticks() {
  local file="$1"
  local max=3
  while IFS= read -r line; do
    if [[ "$line" =~ ^[[:space:]]*(\`+) ]]; then
      local count=${#BASH_REMATCH[1]}
      [ "$count" -ge "$max" ] && max=$((count + 1))
    fi
  done < "$file"
  echo "$max"
}

: > "$OUT"

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

# Urutan sesuai struktur project: layer paling penting duluan
priority_dirs=("src" "public" "scripts" "config" "ROOT")
processed_dirs=()

write_group() {
  local top="$1"
  printf "## Direktori: %s\n\n" "$top" >> "$OUT"
  mapfile -t flist < <(printf '%s\n' "${groups[$top]}" | sort -V)
  for file in "${flist[@]}"; do
    filename="$(basename -- "$file")"
    ext="${filename##*.}"
    [ "$filename" = "$ext" ] && ext="$filename"  # file tanpa ekstensi
    lang="$(lang_for_ext "$ext")"
    printf "### File: \`%s\`\n\n" "$file" >> "$OUT"
    bc=$(count_max_backticks "$file")
    bt=$(printf '`%.0s' $(seq 1 "$bc"))
    [ -n "$lang" ] && printf '%s%s\n' "$bt" "$lang" >> "$OUT" || printf '%s\n' "$bt" >> "$OUT"
    sed 's/\r$//' "$file" >> "$OUT"
    printf '\n%s\n\n---\n\n' "$bt" >> "$OUT"
  done
}

for priority in "${priority_dirs[@]}"; do
  [ -n "${groups[$priority]:-}" ] && write_group "$priority" && processed_dirs+=("$priority")
done

IFS=$'\n'
for top in $(printf '%s\n' "${!groups[@]}" | sort -V); do
  skip=false
  for pd in "${processed_dirs[@]}"; do
    [ "$top" = "$pd" ] && skip=true && break
  done
  $skip && continue
  write_group "$top"
done

echo "Selesai! File '$OUT' telah dibuat (Mode: Astro Project)"
echo "Direktori yang diproses: ${#groups[@]}"
echo "Total file: ${#files[@]}"
