"use client"

import Image from "next/image";
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

            <section className="bg:white py-14 md:py-16">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 mb-12 flex flex-col md:flex-row justify-between gap-12">
                    <div className="md:w-1/2">
                        <h1 className="font-bold text-5xl mb-5">Produk Kami</h1>
                        <p className="text-xl text-justify font-base">PT Silga Perkasa menghadirkan produk Day Old Chick (DOC) berkualitas tinggi yang dihasilkan melalui proses breeding profesional dengan standar mutu yang terjaga. Didukung oleh manajemen modern dan pengawasan yang berkesinambungan, setiap DOC diproduksi untuk memberikan kualitas terbaik serta memenuhi kebutuhan peternak secara optimal.</p>
                    </div>

                    <div className="md:w-1/2 relative h-[200px] md:h-[300px]">
                        <Image
                            src="/images/image-product-1.jpg"
                            fill
                            alt="image produk pT silga perkasa"
                            className="object-cover rounded"
                        ></Image>
                    </div>
                </div>

            </section>
        </div>
    )
}