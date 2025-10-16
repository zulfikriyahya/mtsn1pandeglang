import React, { useState, useEffect } from "react";
import {
  FaChevronLeft,
  FaChevronRight,
  FaGraduationCap,
  FaUser,
  FaBook,
  FaUsers,
  FaInfoCircle,
  FaPause,
  FaPlay,
} from "react-icons/fa";

const mahasiswaData = [
  {
    nama: "Siti Arifah",
    nim: "221250030",
    jurusan: "Manajemen Pendidikan Islam (MPI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/siti-arifah.png",
  },
  {
    nama: "Ine Febriyanti",
    nim: "221250031",
    jurusan: "Manajemen Pendidikan Islam (MPI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/ine-febriyanti.png",
  },
  {
    nama: "Muhammad Faqih Abdul Wafa",
    nim: "221210172",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Euis Sofi Sulasiah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhammad-faqih-abdul-wafa.png",
  },
  {
    nama: "Rihadatul A'isy",
    nim: "221210007",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Euis Sofi Sulasiah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/rihadatul-aisy.png",
  },
  {
    nama: "Muhammad Abdullah",
    nim: "221210118",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "H. Solichul Hadi M.Ag.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhammad-abdullah.png",
  },
  {
    nama: "Siti Khoirunisa",
    nim: "221210100",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "H. Solichul Hadi M.Ag.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/siti-khoirunisa.png",
  },
  {
    nama: "Nur Indah Isnaini",
    nim: "221210020",
    jurusan: "Pendidikan Agama Islam (PAI)",
    guruPamong: "Siti Wahidoh, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/nur-indah-isnaini.png",
  },
  {
    nama: "Susi Susilawati",
    nim: "221220017",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Aam Amalia, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/susi-susilawati.png",
  },
  {
    nama: "Aulia Al Qisti Nazifah",
    nim: "221220026",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Aam Amalia, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/aulia-al-qisti-nazifah.png",
  },
  {
    nama: "Linda Mutia Rahmah",
    nim: "221220060",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/linda-mutia-rahmah.png",
  },
  {
    nama: "Pia Fatmawati",
    nim: "221220075",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/pia-fatmawati.png",
  },
  {
    nama: "Hafidz Dian Nugraha",
    nim: "221220077",
    jurusan: "Pendidikan Bahasa Arab (PBA)",
    guruPamong: "Siti maryam, S.Pd.I.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/hafidz-dian-nugraha.png",
  },
  {
    nama: "Amalia Fatihah",
    nim: "221230073",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Mahbudin, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/amalia-fatihah.png",
  },
  {
    nama: "Alfina Husna Azkia",
    nim: "221230074",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Endah Humaedah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/alfina-husna-azkia.png",
  },
  {
    nama: "Muhoiriah",
    nim: "221230075",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Endah Humaedah, M.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/muhoiriah.png",
  },
  {
    nama: "Nina Isnaiyah",
    nim: "221230077",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Cucu Wakiah, S.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/nina-isnaiyah.png",
  },
  {
    nama: "Khoirotunnisa",
    nim: "221230142",
    jurusan: "Tadris Bahasa Inggris (TBI)",
    guruPamong: "Cucu Wakiah, S.Pd.",
    foto: "/images/artikel/plp-kkn/2025/uin-banten/khoirotunnisa.png",
  },
];

export default function ProfilMahasiswaPLP() {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [isAutoplay, setIsAutoplay] = useState(true);

  useEffect(() => {
    if (!isAutoplay) return;

    const interval = setInterval(() => {
      setCurrentIndex((prev) => (prev + 1) % mahasiswaData.length);
    }, 5000);

    return () => clearInterval(interval);
  }, [isAutoplay]);

  const nextSlide = () => {
    setIsAutoplay(false);
    setCurrentIndex((prev) => (prev + 1) % mahasiswaData.length);
  };

  const prevSlide = () => {
    setIsAutoplay(false);
    setCurrentIndex(
      (prev) => (prev - 1 + mahasiswaData.length) % mahasiswaData.length,
    );
  };

  const goToSlide = (index) => {
    setIsAutoplay(false);
    setCurrentIndex(index);
  };

  const currentMahasiswa = mahasiswaData[currentIndex];

  return (
    // <div className="w-full my-12">
    //   {/* Main Card */}
    //   <div className="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-500">
    //     <div className="relative">
    //       {/* Content Grid */}
    //       <div className="grid lg:grid-cols-5 gap-6 p-6 lg:p-8">
    //         {/* Photo Section */}
    //         <div className="lg:col-span-2 flex items-center justify-center">
    //           <div className="relative w-full max-w-sm">
    //             <div className="aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-blue-50 bg-gradient-to-br from-blue-50 to-indigo-50">
    //               <img
    //                 src={currentMahasiswa.foto}
    //                 alt={currentMahasiswa.nama}
    //                 className="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
    //                 onError={(e) => {
    //                   e.target.src = "/images/avatar.png";
    //                 }}
    //               />
    //             </div>

    //             {/* Number Badge */}
    //             <div className="absolute -bottom-3 -right-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-full w-14 h-14 flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">
    //               {currentIndex + 1}
    //             </div>
    //           </div>
    //         </div>

    //         {/* Info Section */}
    //         <div className="lg:col-span-3 flex flex-col justify-center space-y-6">
    //           {/* Name */}
    //           <div>
    //             <h3 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
    //               {currentMahasiswa.nama}
    //             </h3>
    //             <div className="h-1 w-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full"></div>
    //           </div>

    //           {/* Info Cards */}
    //           <div className="grid gap-4">
    //             {/* NIM */}
    //             <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
    //               <div className="bg-blue-100 p-2.5 rounded-lg flex-shrink-0">
    //                 <FaUser className="text-xl text-blue-600" />
    //               </div>
    //               <div className="min-w-0 flex-1">
    //                 <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
    //                   Nomor Induk Mahasiswa
    //                 </p>
    //                 <p className="text-lg font-bold text-gray-900">
    //                   {currentMahasiswa.nim}
    //                 </p>
    //               </div>
    //             </div>

    //             {/* Jurusan */}
    //             <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
    //               <div className="bg-indigo-100 p-2.5 rounded-lg flex-shrink-0">
    //                 <FaGraduationCap className="text-xl text-indigo-600" />
    //               </div>
    //               <div className="min-w-0 flex-1">
    //                 <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
    //                   Program Studi
    //                 </p>
    //                 <p className="text-lg font-bold text-gray-900">
    //                   {currentMahasiswa.jurusan}
    //                 </p>
    //               </div>
    //             </div>

    //             {/* Guru Pamong */}
    //             <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
    //               <div className="bg-purple-100 p-2.5 rounded-lg flex-shrink-0">
    //                 <FaBook className="text-xl text-purple-600" />
    //               </div>
    //               <div className="min-w-0 flex-1">
    //                 <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
    //                   Guru Pembimbing
    //                 </p>
    //                 <p className="text-lg font-bold text-gray-900">
    //                   {currentMahasiswa.guruPamong}
    //                 </p>
    //               </div>
    //             </div>
    //           </div>
    //         </div>
    //       </div>

    //       {/* Navigation Arrows */}
    //       <button
    //         onClick={prevSlide}
    //         className="absolute left-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
    //         aria-label="Previous"
    //       >
    //         <FaChevronLeft className="text-xl text-gray-700" />
    //       </button>
    //       <button
    //         onClick={nextSlide}
    //         className="absolute right-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
    //         aria-label="Next"
    //       >
    //         <FaChevronRight className="text-xl text-gray-700" />
    //       </button>
    //     </div>

    //     {/* Dots Navigation */}
    //     <div className="flex justify-center items-center gap-2 py-6 px-4 bg-gradient-to-b from-white to-gray-50 overflow-x-auto">
    //       {mahasiswaData.map((_, index) => (
    //         <button
    //           key={index}
    //           onClick={() => goToSlide(index)}
    //           className={`transition-all rounded-full flex-shrink-0 ${
    //             index === currentIndex
    //               ? "w-8 h-2.5 bg-gradient-to-r from-blue-600 to-indigo-600"
    //               : "w-2.5 h-2.5 bg-gray-300 hover:bg-gray-400"
    //           }`}
    //           aria-label={`Go to slide ${index + 1}`}
    //           title={mahasiswaData[index].nama}
    //         />
    //       ))}
    //     </div>

    //     {/* Footer Info */}
    //     <div className="px-6 py-4 bg-gray-50 border-t border-gray-100">
    //       <div className="flex items-center justify-between text-sm">
    //         <span className="text-gray-600">
    //           Mahasiswa{" "}
    //           <span className="font-bold text-gray-900">
    //             {currentIndex + 1}
    //           </span>{" "}
    //           dari{" "}
    //           <span className="font-bold text-gray-900">
    //             {mahasiswaData.length}
    //           </span>
    //         </span>
    //         <button
    //           onClick={() => setIsAutoplay(!isAutoplay)}
    //           className={`flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors ${
    //             isAutoplay
    //               ? "bg-blue-100 text-blue-700 hover:bg-blue-200"
    //               : "bg-gray-200 text-gray-700 hover:bg-gray-300"
    //           }`}
    //         >
    //           {isAutoplay ? (
    //             <>
    //               <FaPause /> Pause
    //             </>
    //           ) : (
    //             <>
    //               <FaPlay /> Play
    //             </>
    //           )}
    //         </button>
    //       </div>
    //     </div>
    //   </div>
    // </div>
    <div className="w-full my-12">
      {/* Main Card */}
      <div className="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-500">
        <div className="relative">
          {/* Content Grid */}
          <div className="grid lg:grid-cols-5 gap-6 p-6 lg:p-8">
            {/* Photo Section */}
            <div className="lg:col-span-2 flex items-center justify-center py-4">
              <div className="relative w-full max-w-sm">
                <div className="aspect-square rounded-2xl overflow-hidden shadow-lg border-4 border-blue-50 bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center p-4">
                  <img
                    src={currentMahasiswa.foto}
                    alt={currentMahasiswa.nama}
                    className="w-full h-full object-contain transition-transform duration-300 hover:scale-105"
                    onError={(e) => {
                      e.target.src = "/images/avatar.png";
                    }}
                  />
                </div>

                {/* Number Badge */}
                <div className="absolute -bottom-3 -right-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-full w-14 h-14 flex items-center justify-center font-bold text-xl shadow-lg border-4 border-white">
                  {currentIndex + 1}
                </div>
              </div>
            </div>

            {/* Info Section */}
            <div className="lg:col-span-3 flex flex-col justify-center space-y-6">
              {/* Name */}
              <div>
                <h3 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                  {currentMahasiswa.nama}
                </h3>
                <div className="h-1 w-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full"></div>
              </div>

              {/* Info Cards */}
              <div className="grid gap-4">
                {/* NIM */}
                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-blue-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaUser className="text-xl text-blue-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Nomor Induk Mahasiswa
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.nim}
                    </p>
                  </div>
                </div>

                {/* Jurusan */}
                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-indigo-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaGraduationCap className="text-xl text-indigo-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Program Studi
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.jurusan}
                    </p>
                  </div>
                </div>

                {/* Guru Pamong */}
                <div className="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                  <div className="bg-purple-100 p-2.5 rounded-lg flex-shrink-0">
                    <FaBook className="text-xl text-purple-600" />
                  </div>
                  <div className="min-w-0 flex-1">
                    <p className="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                      Guru Pembimbing
                    </p>
                    <p className="text-lg font-bold text-gray-900">
                      {currentMahasiswa.guruPamong}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Navigation Arrows */}
          <button
            onClick={prevSlide}
            className="absolute left-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
            aria-label="Previous"
          >
            <FaChevronLeft className="text-xl text-gray-700" />
          </button>
          <button
            onClick={nextSlide}
            className="absolute right-2 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white p-2.5 rounded-full shadow-lg transition-all hover:scale-110 hover:shadow-xl z-10"
            aria-label="Next"
          >
            <FaChevronRight className="text-xl text-gray-700" />
          </button>
        </div>

        {/* Dots Navigation */}
        <div className="flex justify-center items-center gap-2 py-6 px-4 bg-gradient-to-b from-white to-gray-50 overflow-x-auto">
          {mahasiswaData.map((_, index) => (
            <button
              key={index}
              onClick={() => goToSlide(index)}
              className={`transition-all rounded-full flex-shrink-0 ${
                index === currentIndex
                  ? "w-8 h-2.5 bg-gradient-to-r from-blue-600 to-indigo-600"
                  : "w-2.5 h-2.5 bg-gray-300 hover:bg-gray-400"
              }`}
              aria-label={`Go to slide ${index + 1}`}
              title={mahasiswaData[index].nama}
            />
          ))}
        </div>

        {/* Footer Info */}
        <div className="px-6 py-4 bg-gray-50 border-t border-gray-100">
          <div className="flex items-center justify-between text-sm">
            <span className="text-gray-600">
              Mahasiswa{" "}
              <span className="font-bold text-gray-900">
                {currentIndex + 1}
              </span>{" "}
              dari{" "}
              <span className="font-bold text-gray-900">
                {mahasiswaData.length}
              </span>
            </span>
            <button
              onClick={() => setIsAutoplay(!isAutoplay)}
              className={`flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium transition-colors ${
                isAutoplay
                  ? "bg-blue-100 text-blue-700 hover:bg-blue-200"
                  : "bg-gray-200 text-gray-700 hover:bg-gray-300"
              }`}
            >
              {isAutoplay ? (
                <>
                  <FaPause /> Pause
                </>
              ) : (
                <>
                  <FaPlay /> Play
                </>
              )}
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
