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

            <section className="bg:white">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 py-10 grid grid-cols-1 md:grid-cols-3 gap-5">

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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
                            <h3 className="text-[25px] font-bold">Lorem ipsum</h3>
                            <p className="text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>

                    </motion.div>
                </div>
            </section>
        </div>
    )
}