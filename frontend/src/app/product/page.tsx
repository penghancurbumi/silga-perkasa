"use client"

import Image from "next/image";
import { Icon } from "@iconify/react";
import { motion } from "framer-motion";

export default function Product() {
    return (
        <div className="flex flex-col min-h-screen font-sans">
            <section className="relative w-full h-[40vh] md:h-[50vh] lg:h-[60vh]">
                <div className="absolute inset-0">
                    <Image
                        src="/images/background-contact.jpg"
                        alt="background contact pages"
                        fill
                        className="object-cover object-top md:object-center"
                    />
                    <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
                </div>

                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8 }}
                    className="relative z-[5] flex items-center justify-center h-full">
                    <span className="font-medium text-6xl text-white">Product</span>
                </motion.div>
            </section>

            <section className="bg-white py-16 md:py-24 overflow-hidden">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 mb-12 flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-20">
                    <motion.div
                        initial={{ opacity: 0, x: -50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="md:w-1/2"
                    >
                        <h1 className="font-bold text-4xl md:text-5xl text-gray-900 mb-4">Produk Kami</h1>
                        <div className="w-20 h-1.5 bg-[#003B65] rounded-full mb-8"></div>
                        <p className="text-lg md:text-xl text-justify text-gray-600 leading-relaxed">
                            PT Silga Perkasa menghadirkan produk <span className="font-semibold text-gray-800">Day Old Chick (DOC)</span> berkualitas tinggi yang dihasilkan melalui proses breeding profesional dengan standar mutu yang terjaga. Didukung oleh manajemen modern dan pengawasan yang berkesinambungan, setiap DOC diproduksi untuk memberikan kualitas terbaik serta memenuhi kebutuhan peternak secara optimal.
                        </p>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: 50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="md:w-1/2 relative w-full h-[250px] md:h-[400px]"
                    >

                        <div className="relative z-10 w-full h-full rounded-2xl overflow-hidden shadow-2xl">
                            <Image
                                src="/images/image-product-1.jpg"
                                fill
                                alt="image produk pT silga perkasa"
                                className="object-cover hover:scale-105 transition-transform duration-700"
                            />
                        </div>
                    </motion.div>
                </div>
            </section>

            <section className="bg-gray-50 py-16 md:py-24 overflow-hidden">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-20">
                    <motion.div
                        initial={{ opacity: 0, x: -50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="md:w-1/2 relative w-full h-[300px] md:h-[600px]"
                    >
                        <div className="relative z-10 w-full h-full rounded-2xl overflow-hidden shadow-2xl">
                            <Image
                                src="/images/little-chicks-farm (1).jpg"
                                fill
                                alt="image produk pT silga perkasa"
                                className="object-cover hover:scale-105 transition-transform duration-700"
                            />
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: 50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="md:w-1/2 space-y-8"
                    >
                        <div className="space-y-4">
                            <div className="flex items-center gap-3">
                                <div className="w-12 h-1 bg-[#003B65] rounded-full"></div>
                                <p className="text-sm font-semibold text-[#003B65] uppercase tracking-wider">Produk Unggulan</p>
                            </div>
                            <h1 className="font-bold text-4xl md:text-5xl text-gray-900">Day Old Chick (DOC)</h1>
                            <p className="text-lg text-justify text-gray-600 leading-relaxed">
                                <span className="font-semibold text-gray-800">Day Old Chick (DOC)</span> merupakan bibit ayam broiler yang diproduksi dari parent stock berkualitas melalui proses pemeliharaan dan penetasan yang terstandarisasi. PT Silga Perkasa berkomitmen menghasilkan DOC dengan kondisi sehat, kualitas yang konsisten, serta siap mendukung produktivitas peternakan broiler.
                            </p>
                        </div>

                        <ul className="space-y-6 pt-4">
                            {[
                                {
                                    judul: "Kondisi Sehat & Lincah",
                                    deskripsi: "Menghasilkan DOC dengan kualitas terbaik sesuai standar perusahaan.",
                                },
                                {
                                    judul: "Kesehatan Terjamin",
                                    deskripsi: "Diproduksi dari indukan yang dipelihara dengan pengelolaan kesehatan yang baik.",
                                },
                                {
                                    judul: "Kualitas Konsisten",
                                    deskripsi: "Mengutamakan pengendalian mutu pada setiap proses produksi.",
                                },
                                {
                                    judul: "Manajemen Modern",
                                    deskripsi: "Didukung sistem breeding dan hatchery yang dikelola secara profesional.",
                                }
                            ].map((item, index) => (
                                <motion.li
                                    key={index}
                                    initial={{ opacity: 0, y: 20 }}
                                    whileInView={{ opacity: 1, y: 0 }}
                                    viewport={{ once: true, margin: "-50px" }}
                                    transition={{ duration: 0.5, delay: index * 0.15 }}
                                    className="flex items-start gap-5"
                                >
                                    <div className="bg-[#003B65] shrink-0 flex items-center justify-center w-12 h-12 rounded-full shadow-md mt-1">
                                        <Icon
                                            icon="teenyicons:tick-small-outline"
                                            className="w-7 h-7 text-white"
                                        />
                                    </div>

                                    <div className="flex flex-col gap-1.5">
                                        <span className="text-xl font-bold text-gray-800">{item.judul}</span>
                                        <p className="text-base text-gray-500 leading-relaxed">{item.deskripsi}</p>
                                    </div>
                                </motion.li>
                            ))}
                        </ul>
                    </motion.div>
                </div>
            </section>

            <section className="bg-white py-16 md:py-24">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24">

                    <motion.div
                        initial={{ opacity: 0, y: -20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6 }}
                        className="flex flex-col items-center text-center mb-16"
                    >
                        <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                            Mengapa Memilih Produk Kami
                        </h2>
                        <div className="w-24 h-1.5 bg-[#003B65] rounded-full"></div>
                        <p className="text-gray-500 mt-6 max-w-2xl text-lg">
                            Keunggulan produk PT Silga Perkasa yang menjadikannya pilihan tepat untuk kebutuhan peternakan Anda.
                        </p>
                    </motion.div>

                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                        {[
                            {
                                judul: "Kualitas Terjamin",
                                deskripsi: "Setiap DOC diproduksi dengan standar mutu yang konsisten untuk memberikan kualitas terbaik kepada pelanggan.",
                                ikon: "mdi:shield-check-outline"
                            },
                            {
                                judul: "Bibit Sehat",
                                deskripsi: "Mengutamakan kesehatan parent stock dan proses pemeliharaan yang terkontrol sehingga menghasilkan DOC yang sehat.",
                                ikon: "mdi:heart-pulse"
                            },
                            {
                                judul: "Manajemen Profesional",
                                deskripsi: "Didukung sistem breeding, hatchery, dan operasional yang dikelola secara modern untuk menjaga kualitas produk.",
                                ikon: "mdi:briefcase-check-outline"
                            },
                            {
                                judul: "Fokus pada Pelanggan",
                                deskripsi: "Berkomitmen memberikan pelayanan terbaik melalui peningkatan mutu dan kepuasan pelanggan secara berkelanjutan.",
                                ikon: "mdi:handshake-outline"
                            }
                        ].map((item, index) => (
                            <motion.div
                                key={index}
                                initial={{ opacity: 0, y: 10 }}
                                whileInView={{ opacity: 1, y: 0 }}
                                viewport={{ once: true, margin: "-15px" }}
                                transition={{ duration: 0.15, delay: index * 0.15 }}
                                whileHover={{ y: -2, transition: { duration: 0.15 } }}
                                className="bg-white rounded-2xl border border-gray-200 shadow p-8 flex flex-col items-center text-center group transition-all duration-150"
                            >
                                <div className="bg-blue-50 group-hover:bg-[#003B65] transition-colors duration-150 rounded-2xl p-4 mb-6">
                                    <Icon icon={item.ikon} className="text-4xl text-[#003B65] group-hover:text-white transition-colors duration-200" />
                                </div>

                                <div className="flex flex-col gap-3">
                                    <h3 className="text-xl font-bold text-gray-900 group-hover:text-[#003B65] transition-colors duration-300">{item.judul}</h3>
                                    <p className="text-sm text-gray-500 leading-relaxed">
                                        {item.deskripsi}
                                    </p>
                                </div>
                            </motion.div>
                        ))}
                    </div>
                </div>
            </section>
        </div>
    )
}