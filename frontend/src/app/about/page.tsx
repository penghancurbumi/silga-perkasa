"use client"

import { useRef } from "react";
import Image from "next/image";
import { motion, useScroll, useTransform } from "framer-motion";
import { Icon } from "@iconify/react";

export default function About() {
    const containerRef = useRef<HTMLDivElement>(null);
    const { scrollYProgress } = useScroll({
        target: containerRef,
        offset: ["start start", "end end"]
    });

    const line1 = useTransform(scrollYProgress, [0, 0.4], ["0%", "100%"]);
    const line2 = useTransform(scrollYProgress, [0.4, 0.8], ["0%", "100%"]);

    const bg1 = useTransform(scrollYProgress, [0, 0.1], ["#e5e7eb", "#003B65"]);
    const bg2 = useTransform(scrollYProgress, [0.3, 0.4], ["#e5e7eb", "#003B65"]);
    const bg3 = useTransform(scrollYProgress, [0.7, 0.8], ["#e5e7eb", "#003B65"]);

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
                    <span className="font-medium text-6xl text-white">Tentang Kami</span>
                </motion.div>
            </section>

            <section className="bg-white py-16 md:py-24 overflow-hidden">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-20">
                    <motion.div
                        initial={{ opacity: 0, x: -50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="md:w-1/2 relative w-full h-[300px] md:h-[500px]"
                    >
                        <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                            <Image
                                src="/images/little-chicks-farm (1).jpg"
                                fill
                                alt="image produk pT silga perkasa"
                                className="object-cover"
                            />
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, x: 50 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="w-full md:w-1/2"
                    >
                        <div className="flex flex-col gap-4">

                            <span className="text-sm font-semibold uppercase tracking-wider text-[#003B65]">
                                About Us
                            </span>

                            <h1 className="font-bold text-3xl md:text-5xl text-gray-900 mb-6 leading-tight tracking-tight">
                                Membangun Kepercayaan melalui Kualitas dan Komitmen
                            </h1>

                            <p className="text-lg md:text-xl text-gray-600 text-justify leading-relaxed">PT Silga Perkasa merupakan perusahaan yang bergerak di bidang breeding broiler dengan fokus pada produksi Day Old Chick (DOC) berkualitas. Berdiri sejak 2 Desember 1985 di Sukabumi, Jawa Barat, perusahaan terus berkomitmen menghadirkan produk unggul melalui pengelolaan parent stock yang profesional, manajemen modern, serta standar kualitas yang terjaga. Kolaborasi yang baik antara tim operasional dan supporting menjadi fondasi dalam menghasilkan produk yang memenuhi kebutuhan pelanggan.</p>
                        </div>
                    </motion.div>
                </div>
            </section>

            <section className="bg-white pb-16 md:pb-24 pt-0 md:pt-4">
                <div className="w-full px-8 md:px-16 lg:px-24 flex flex-col gap-12">

                    {/* MISI (Atas) */}
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8 }}
                        className="w-full flex flex-col md:flex-row items-start gap-24 pt-12"
                    >
                        <div className="shrink-0 md:w-1/3 border-t border-gray-400 pt-12">
                            <h2 className="text-4xl md:text-5xl font-bold text-black">Misi</h2>
                        </div>
                        <p className="text-xl md:text-2xl text-gray-700 leading-relaxed md:w-2/3 text-justify md:text-left md:pt-6">
                            Menetapkan dan mengembangkan manajemen di atas standar secara terus-menerus.
                        </p>
                    </motion.div>

                    {/* VISI (Bawah) */}
                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-100px" }}
                        transition={{ duration: 0.8, delay: 0.2 }}
                        className="w-full flex flex-col md:flex-row items-start gap-24 pt-12"
                    >
                        <div className="shrink-0 md:w-1/3 border-t border-gray-400 pt-12">
                            <h2 className="text-4xl md:text-5xl font-bold text-black">Visi</h2>
                        </div>
                        <p className="text-xl md:text-2xl text-gray-700 leading-relaxed md:w-2/3 text-justify md:text-left md:pt-6">
                            Menjadi perusahaan pembibitan terbaik dengan jaminan kualitas tinggi dan layanan terbaik bagi pelanggan, karyawan dan pemangku kepentingan.
                        </p>
                    </motion.div>

                </div>
            </section>
            <section ref={containerRef} className="bg-white relative h-[250vh]">
                <div className="sticky top-20 w-full min-h-screen overflow-hidden pt-12 pb-16">
                    <div className="w-full mx-auto px-8 md:px-16 lg:px-24 flex flex-col md:flex-row items-start justify-between gap-12 lg:gap-20">


                        <motion.div
                            initial={{ opacity: 0, y: 50 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true, margin: "-100px" }}
                            transition={{ duration: 0.8 }}
                            className="md:w-1/2"
                        ><div className="flex flex-col gap-4 max-w-3xl">
                                <span className="text-sm font-semibold uppercase tracking-wider text-[#003B65]">
                                    Sejarah
                                </span>

                                <h2 className="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                                    Perjalanan Kami
                                </h2>

                                <p className="text-lg md:text-xl leading-relaxed text-gray-600 text-justify">
                                    Sejak tahun 1985, PT Silga Perkasa telah menempuh perjalanan panjang dalam
                                    mengembangkan bisnis breeding broiler. Dengan komitmen terhadap kualitas,
                                    inovasi, dan pelayanan, perusahaan terus bertumbuh serta menghadirkan DOC
                                    berkualitas tinggi yang menjadi pilihan terpercaya bagi industri
                                    perunggasan di Indonesia.
                                </p>
                            </div>
                        </motion.div>

                        <motion.div
                            initial={{ opacity: 0, y: 50 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true, margin: "-100px" }}
                            transition={{ duration: 0.8, delay: 0.3 }}
                            className="md:w-1/2"
                        >
                            <div className="relative flex flex-col gap-0 py-4">
                                {/* Item 1 */}
                                <div className="flex gap-6 relative z-10">
                                    {/* Line Segment 1 */}
                                    <div className="absolute left-[19px] top-5 bottom-[-20px] w-[2px] bg-gray-200 -z-10"></div>
                                    <motion.div
                                        className="absolute left-[19px] top-5 bottom-[-20px] w-[2px] bg-[#003B65] -z-10 origin-top"
                                        style={{ scaleY: line1 }}
                                    ></motion.div>

                                    <motion.div
                                        className="rounded-full w-10 h-10 border-[4px] border-white shrink-0 flex items-center justify-center shadow-sm z-10"
                                        style={{ backgroundColor: bg1 }}
                                    >
                                        <div className="w-3 h-3 bg-white rounded-full"></div>
                                    </motion.div>

                                    <div className="flex flex-col gap-2 pt-0 pb-12">
                                        <h3 className="font-bold text-xl md:text-2xl text-[#003B65]">1985</h3>
                                        <h4 className="font-bold text-lg md:text-xl text-gray-900">Pendirian Perusahaan</h4>
                                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">PT Silga Perkasa didirikan di Sukabumi, Jawa Barat pada 2 Desember 1985, memulai langkah awal di bidang breeding broiler.</p>
                                    </div>
                                </div>

                                {/* Item 2 */}
                                <div className="flex gap-6 relative z-10">
                                    {/* Line Segment 2 */}
                                    <div className="absolute left-[19px] top-5 bottom-[-20px] w-[2px] bg-gray-200 -z-10"></div>
                                    <motion.div
                                        className="absolute left-[19px] top-5 bottom-[-20px] w-[2px] bg-[#003B65] -z-10 origin-top"
                                        style={{ scaleY: line2 }}
                                    ></motion.div>

                                    <motion.div
                                        className="rounded-full w-10 h-10 border-[4px] border-white shrink-0 flex items-center justify-center shadow-sm z-10"
                                        style={{ backgroundColor: bg2 }}
                                    >
                                        <div className="w-3 h-3 bg-white rounded-full"></div>
                                    </motion.div>
                                    <div className="flex flex-col gap-2 pt-0 pb-12">
                                        <h3 className="font-bold text-xl md:text-2xl text-[#003B65]">2000</h3>
                                        <h4 className="font-bold text-lg md:text-xl text-gray-900">Penerapan Manajemen Modern</h4>
                                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">Perusahaan mulai melakukan ekspansi dan penerapan manajemen modern untuk meningkatkan kualitas Day Old Chick (DOC).</p>
                                    </div>
                                </div>

                                {/* Item 3 */}
                                <div className="flex gap-6 relative z-10">
                                    <motion.div
                                        className="rounded-full w-10 h-10 border-[4px] border-white shrink-0 flex items-center justify-center shadow-sm z-10"
                                        style={{ backgroundColor: bg3 }}
                                    >
                                        <div className="w-3 h-3 bg-white rounded-full"></div>
                                    </motion.div>
                                    <div className="flex flex-col gap-2 pt-0 pb-4">
                                        <h3 className="font-bold text-xl md:text-2xl text-[#003B65]">Sekarang</h3>
                                        <h4 className="font-bold text-lg md:text-xl text-gray-900">Komitmen Kualitas Unggul</h4>
                                        <p className="text-gray-600 leading-relaxed text-sm md:text-base">Terus berkomitmen menghadirkan produk unggul melalui pengelolaan parent stock yang profesional dan standar kualitas tinggi.</p>
                                    </div>
                                </div>
                            </div>
                        </motion.div>
                    </div>
                </div>
            </section>

            <section className="bg-gray-50 py-16 md:py-24">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 mb-12 flex flex-col items-center justify-center gap-4 text-center">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6 }}
                        className="flex items-center gap-3">
                        <span
                            className="text-[#003B65] font-semibold tracking-widest text-sm uppercase"
                        >
                            Core Values
                        </span>
                    </motion.div>

                    <motion.h2
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6, delay: 0.15 }}
                        className="text-3xl md:text-5xl font-medium leading-tight max-w-4xl"
                    >
                        Membangun Kepercayaan Melalui Nilai & Komitmen Kami
                    </motion.h2>

                    <motion.p
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6, delay: 0.3 }}
                        className="text-gray-600 max-w-2xl text-center"
                    >
                        Kami senantiasa memegang teguh prinsip-prinsip ini dalam setiap langkah dan layanan yang kami berikan untuk memastikan kepuasan mitra dan klien kami.
                    </motion.p>
                </div>

                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 grid grid-cols-1 md:grid-cols-3 gap-6">

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Integrity</h3>
                            <p className="text-sm text-justify">Kami menjalankan setiap prinsip usaha dengan kejujuran dan tanggung jawab penuh. Setiap komitmen yang dijanjikan kepada pelanggan dan mitra bisnis akan selalu kami penuhi secara konsisten.</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Trust</h3>
                            <p className="text-sm text-justify">Kepercayaan pelanggan adalah aset terbesar kami yang dibangun melalui konsistensi kualitas produk dan layanan, sehingga tercipta hubungan jangka panjang yang harmonis bersama seluruh pelanggan.</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Innovation</h3>
                            <p className="text-sm text-justify">Kami terus mendorong inovasi berkelanjutan dengan menciptakan lingkungan kerja yang kondusif dan penerapan teknologi modern dalam menghasilkan DOC berkualitas tinggi.</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Grow</h3>
                            <p className="text-sm text-justify">Kami terus bertumbuh dengan mengembangkan produk, sistem, dan kapasitas operasional berbasis manajemen modern demi memberikan nilai terbaik bagi pelanggan dan masyarakat sekitar.</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Quality</h3>
                            <p className="text-sm text-justify">Setiap DOC (Day Old Chick) yang kami hasilkan melewati proses pemeliharaan ketat dengan standar kesehatan ternak terjaga, sebagai bukti nyata komitmen kami menghadirkan produk terbaik</p>
                        </div>
                    </motion.div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true, margin: "-50px" }}
                        transition={{ duration: 0.5 }}
                        whileHover={{ y: -5 }}
                        className="bg-white rounded-xl border border-gray-200 shadow-sm p-8"
                    >
                        <div className="bg-[#003B65] rounded-md p-3 w-fit mb-3">
                            <Icon icon="mdi:user-check" className="text-3xl text-white" />
                        </div>
                        <div className="flex flex-col gap-2">
                            <h3 className="text-[25px] font-bold">Performance</h3>
                            <p className="text-sm text-justify">Kami mendorong setiap karyawan untuk terus berkembang dan berkontribusi optimal, sehingga PT Silga Perkasa mampu menjaga standar kinerja terbaik secara konsisten.</p>
                        </div>
                    </motion.div>

                </div>
            </section>
        </div>
    )
}