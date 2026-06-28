"use client"
import Image from "next/image"
import { motion } from "framer-motion"
import { Icon } from "@iconify/react"

export default function commitment() {

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
                    <h1 className="font-medium text-6xl text-white">Commitment</h1>
                </motion.div>
            </section>

            <section className="bg-white py-14 md:py-16">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 mb-12 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div className="md:w-1/2">

                        <motion.div
                            initial={{ opacity: 0, x: -30 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.6 }}
                            className="flex items-center gap-3 mb-3">

                            <div className="w-12 h-1 bg-[#003B65] rounded-full"></div>
                            <span
                                className="text-[#003B65] font-semibold tracking-widest text-sm uppercase"
                            >
                                Tujuan Kami
                            </span>
                        </motion.div>

                        <motion.h2
                            initial={{ opacity: 0, x: -30 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.6, delay: 0.15 }}
                            className="text-3xl md:text-5xl font-medium leading-tight mb-3"
                        >
                            Membangun Kepercayaan Melalui Nilai & Komitmen Kami
                        </motion.h2>
                    </div>

                    <motion.p
                        initial={{ opacity: 0, x: 30 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.6, delay: 0.3 }}
                        className="text-gray-600 md:w-1/3 text-justify"
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