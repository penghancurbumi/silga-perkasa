"use client"
import Image from "next/image"

export default function Home() {
    return (
        <div className="flex flex-col min-h-screen font-sans">
            <section className="relative flex h-screen items-center justify-center text-white overflow-hidden">
                <div className="absolute inset-0 ">
                    <Image
                        src="/images/chicken-farm-scene-with-poultry-people.jpg"
                        alt="farm ayam silga perkasa"
                        fill
                        className="object-cover object-top md:object-center"
                    />
                    <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70" />
                </div>

                {/*Hero section*/}
                <div className="relative z-10 px-8 md:px-16 lg:px-24 w-full">
                    <div className="flex flex-col-reverse md:flex-row items-center justify-between gap-10 min-h-[30vh] md:min-h-[60vh]">

                        <div className="w-full text-center md:text-left">
                            <h1 className="text-4xl md:text-5xl lg:text-7xl font-light text-white mb-4 tracking-tight leading-[1.1]">
                                Building Quality Poultry
                                <span className="font-medium block mt-1">for a Better Future</span>
                            </h1>
                            <p className="text-white text-[18px] mb-6 w-[80vh]">PT Silga Perkasa adalah perusahaan breeding broiler yang menghasilkan DOC berkualitas tinggi melalui standar mutu, manajemen modern, dan pelayanan terbaik sejak tahun 1985.</p>

                            <div className="flex flex-row gap-4">
                                <button className="bg-[#003B65] hover:bg-blue-900 text-white px-8 py-2 md:px-10 md:py-3 min-w-[140px] md:min-w-[160px] text-[12px] font-medium rounded shadow-md hover:shadow-lg transition-all cursor-pointer">
                                    Lihat Produk Kami
                                </button>

                                <button className="bg-white hover:bg-gray-100 text-black px-8 py-2 md:px-10 md:py-3 min-w-[140px] md:min-w-[160px] text-[12px] font-medium rounded shadow-md hover:shadow-lg transition-all cursor-pointer">
                                    Tentang kami
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    )
}