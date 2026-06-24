// app/career/[id]/page.tsx
import { jobs } from "@/lib/job";
import Image from "next/image";
import { Icon } from "@iconify/react";

export default function CareerDetailPage({ params }: { params: { id: string } }) {
  const job = jobs.find((j) => j.id === decodeURIComponent(params.id))


  return (
    <div className="w-full bg-white pt-20">

      <div className="relative h-[200px] md:h-[300px]">
        <Image
          src="/images/background-career-detail.jpg"
          alt="background career detail"
          fill
          className="object-cover"
        />
      </div>

      <div className="absolute bg-white left-20 top-85 rounded-lg h-[70px] w-[70px] overflow-hidden shadow">
        <Image
          src="/images/logo.png"
          alt="logo pt silga perkasa"
          fill
          className="object-cover"></Image>
      </div>

      <div className="bg-[#FAFAFA] w-full">
        <div className="px-8 md:px-14 lg:px-20 py-12 md:py-16 space-y-4">

          <div className="flex flex-row justify-between">
            <h1 className="font-semibold text-3xl">Heavy Equipment Operator</h1>

            <div className="flex items-center">
              <button className="px-5 h-10 bg-[#003B65] text-white rounded text-[12px] cursor-pointer">Apply Now</button>
            </div>
          </div>

          <div className="flex flex-row items-center space-x-3 mt-3 border-b border-gray-300 pb-4">

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="famicons:location-outline"
                className="text-gray-500 w-5 h-5"
              ></Icon>

              <span className="text-gray-500 text-[12px]">Kalimantan Tengah</span>
            </div>

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="mdi:clock-outline"
                className="text-gray-500 w-5 h-5"
              ></Icon>

              <span className="text-[12px] text-gray-500">Full Time</span>
            </div>

            <div className="flex flex-row items-center gap-2">
              <Icon
                icon="uil:suitcase-alt"
                className="text-gray-500 w-5 h-5"
              ></Icon>

              <span className="text-gray-500 text-[12px]">Operations</span>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-white col-span-2 rounded-lg p-6 space-y-6 shadow">
              <div className="flex flex-col gap-2">
                <h3 className="font-semibold text-xl">About Job</h3>
                <p className="text-[13px]">Heavy Equipment Operator bertanggung jawab untuk mengoperasikan berbagai jenis alat berat secara aman, efisien, dan sesuai dengan standar operasional perusahaan guna mendukung kelancaran aktivitas operasional.
                  Posisi ini mencakup pelaksanaan pemeriksaan harian terhadap kondisi alat sebelum dan sesudah digunakan, memastikan alat selalu berada dalam kondisi yang layak operasi, serta melaporkan apabila ditemukan kerusakan atau indikasi gangguan. Selain itu, Heavy Equipment Operator diharapkan mampu bekerja sama dengan tim di lapangan, mengikuti prosedur keselamatan dan kesehatan kerja (K3), serta mengoperasikan alat secara tepat untuk mencapai target produktivitas tanpa mengabaikan aspek keamanan, kualitas pekerjaan, dan perawatan alat berat.
                </p>
              </div>

            <div className="flex flex-col gap-2">
                <h3 className="text-lg font-semibold">Qualifications</h3>

                <ul className="list-disc pl-5 space-y-2 text-[12px] text-gray-700">
                    <li>Minimal lulusan SMA/SMK atau sederajat.</li>
                    <li>Memiliki pengalaman sebagai Heavy Equipment Operator minimal 1–2 tahun menjadi nilai tambah.</li>
                    <li>Memiliki Surat Izin Operator (SIO) yang masih berlaku sesuai jenis alat yang dioperasikan.</li>
                    <li>Memahami prosedur Keselamatan dan Kesehatan Kerja (K3).</li>
                    <li>Bersedia bekerja dengan sistem shift dan ditempatkan di lokasi operasional perusahaan.</li>
                    <li>Mampu melakukan pemeriksaan harian (daily inspection) terhadap alat berat.</li>
                    <li>Memiliki kondisi fisik yang sehat dan mampu bekerja di lingkungan lapangan.</li>
                </ul>
            </div>

              <div className="flex flex-col gap-2">
                <h3 className="font-semibold text-lg">Skills</h3>

                <div className="flex flex-row gap-2">
                  <span className="px-4 py-2 rounded-xl bg-gray-100 text-[10px]">Heavy Equipment Operation</span>
                  <span className="px-4 py-2 rounded-xl bg-gray-100 text-[10px]">Equipment Inspection</span>
                  <span className="px-4 py-2 rounded-xl bg-gray-100 text-[10px]">Safety Awareness</span>
                  <span className="px-4 py-2 rounded-xl bg-gray-100 text-[10px]">Preventive Maintenance</span>
                  <span className="px-4 py-2 rounded-xl bg-gray-100 text-[10px]">Teamwork</span>
                </div>

              </div>
            </div>

            <div className="bg-white rounded-lg shadow p-6 space-y-4 md:sticky md:top-24 h-fit">
              <div className="flex items-center justify-between">
                <h3 className="font-semibold text-lg">Latest Job</h3>
                <span className="text-xs text-gray-400">{jobs.filter(j => j.id !== job?.id).length} positions</span>
              </div>

              <div className="flex flex-col gap-3 overflow-y-auto max-h-[450px] pr-2 
                [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent 
                [&::-webkit-scrollbar-thumb]:bg-gray-200 [&::-webkit-scrollbar-thumb]:rounded-full 
                hover:[&::-webkit-scrollbar-thumb]:bg-gray-300">
                {jobs
                  .filter(j => j.id !== job?.id)
                  .slice(0, 5)
                  .map((item) => (
                    <a
                      key={item.id}
                      href={`/career/${encodeURIComponent(item.id)}`}
                      className="flex flex-col w-full bg-transparent hover:bg-gray-50 border border-transparent hover:border-gray-200 gap-2 rounded-lg p-3 transition-all duration-200 group"
                    >
                      <span className="font-semibold text-sm group-hover:text-[#003B65] transition-colors">{item.title}</span>
                      <p className="text-xs text-gray-500 line-clamp-2">{item.description}</p>

                      <div className="flex flex-row gap-3 mt-1">
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="famicons:location-outline" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400">{item.location}</span>
                        </div>
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="mdi:clock-outline" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400">{item.type}</span>
                        </div>
                        <div className="flex flex-row items-center gap-1.5">
                          <Icon icon="uil:suitcase-alt" className="text-gray-400 w-3 h-3" />
                          <span className="text-[11px] text-gray-400">{item.dept}</span>
                        </div>
                      </div>
                    </a>
                  ))}
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  )
}

