"use client"

import Image from "next/image"
import { Icon } from "@iconify/react"
import { motion } from "framer-motion"
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod"
import { z } from "zod";
import { useRef, useState } from "react";
import ReCAPTCHA from "react-google-recaptcha";

const schema = z.object({
    nama: z.string().min(2, "Nama minimal 2 karakter"),
    email: z.string().email("Format email tidak valid"),
    noHp: z.string().min(9, "Nomor HP tidak valid").max(15),
    pesan: z.string().min(10, "Pesan minimal 10 karakter"),
})

type FormData = z.infer<typeof schema>

export default function Contact() {
    const [status, setStatus] = useState<"idle" | "loading" | "success" | "error">("idle")
    const [errorMessage, setErrorMessage] = useState<string>("")
    const recaptchaRef = useRef<ReCAPTCHA>(null)

    const {
        register,
        handleSubmit,
        reset,
        formState: { errors },
    } = useForm<FormData>({ resolver: zodResolver(schema) })

    const onSubmit = async (data: FormData) => {
        setStatus("loading")
        setErrorMessage("")
        try {
            // Ambil token reCAPTCHA v2 (Checkbox)
            const recaptchaToken = recaptchaRef.current?.getValue()
            
            if (!recaptchaToken) {
                alert("Tolong centang kotak reCAPTCHA (I'm not a robot) terlebih dahulu.")
                setStatus("idle")
                return
            }

            const res = await fetch("/api/contact", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ ...data, recaptchaToken }),
            })

            if (!res.ok) {
                const err = await res.json()
                throw new Error(err.error)
            }

            setStatus("success")
            reset()
        } catch (e: any) {
            console.error(e)
            setStatus("error")
            setErrorMessage(e.message || "Terjadi kesalahan server.")
        }
    }

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
                        <span className="font-medium text-6xl text-white">Contact</span>
                    </motion.div>
                </section>

                <section className="bg-white">
                    <div className="w-full mx-auto px-8 md:px-16 lg:px-24 py-10 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <motion.div
                            initial={{ opacity: 0, x: -30 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.8, delay: 0.2 }}
                            className="text-left p-8">

                            <div className="flex flex-col mb-8 gap-6">
                                <h1 className="text-5xl font-medium">Contact Information</h1>
                                <span className="text-[15px] text-gray-400">Memiliki pertanyaan atau membutuhkan bantuan? Hubungi tim kami melalui informasi kontak berikut dan kami akan segera merespons kebutuhan Anda.</span>
                            </div>


                            <div className="flex flex-col gap-6">

                                <div className="flex flex-row gap-3 items-center border-b border-gray-200 pb-5">
                                    <div className="bg-gray-100 rounded-lg w-16 h-16 shrink-0 flex items-center justify-center">
                                        <Icon
                                            icon="famicons:location-outline"
                                            className="w-8 h-8 text-[#003B65]"
                                        ></Icon>
                                    </div>

                                    <div className="flex flex-col flex-1">
                                        <span className="text-2xl font-semibold">Location</span>
                                        <span className="text-lg font-base text-gray-400 ">Jl. Pelabuhan II No.385, Dayeuhluhur, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43134</span>
                                    </div>
                                </div>

                                <div className="flex flex-row gap-3 items-center border-b border-gray-200 pb-5">
                                    <div className="bg-gray-100 rounded-lg w-16 h-16 shrink-0 flex items-center justify-center">
                                        <Icon
                                            icon="ic:outline-phone"
                                            className="w-8 h-8 text-[#003B65]"
                                        ></Icon>
                                    </div>

                                    <div className="flex flex-col flex-1">
                                        <span className="text-2xl font-semibold">Phone</span>
                                        <span className="text-lg font-base text-gray-400">0266 -224802</span>
                                    </div>
                                </div>

                                <div className="flex flex-row gap-3 items-center border-b border-gray-200 pb-5">
                                    <div className="bg-gray-100 rounded-lg w-16 h-16 shrink-0 flex items-center justify-center">
                                        <Icon
                                            icon="ic:outline-email"
                                            className="w-8 h-8 text-[#003B65]"
                                        ></Icon>
                                    </div>

                                    <div className="flex flex-col flex-1">
                                        <span className="text-2xl font-semibold">Email</span>
                                        <span className="text-lg font-base text-gray-400">office@silgaperkasa.co.id</span>
                                    </div>
                                </div>

                                <div className="flex flex-row gap-3 items-center">
                                    <div className="bg-gray-100 rounded-lg w-16 h-16 shrink-0 flex items-center justify-center">
                                        <Icon
                                            icon="mdi:web"
                                            className="w-8 h-8 text-[#003B65]"
                                        ></Icon>
                                    </div>

                                    <div className="flex flex-col flex-1">
                                        <span className="text-2xl font-semibold">Website</span>
                                        <span className="text-lg font-base text-gray-400">www.silgaperkasa.com</span>
                                    </div>
                                </div>

                            </div>
                        </motion.div>

                        <motion.form
                            onSubmit={handleSubmit(onSubmit)}
                            initial={{ opacity: 0, x: 30 }}
                            whileInView={{ opacity: 1, x: 0 }}
                            viewport={{ once: true }}
                            transition={{ duration: 0.8, delay: 0.4 }}
                            className="text-left border border-gray-200 shadow rounded-2xl p-10 space-y-4">

                            {status === "success" && (
                                <div className="p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 text-sm">
                                    Terima kasih! Pesan Anda telah berhasil dikirim.
                                </div>
                            )}

                            {status === "error" && (
                                <div className="p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 text-sm">
                                    {errorMessage}
                                </div>
                            )}

                            <div className="flex flex-col gap-2">
                                <span className="text-[20px] font-semibold">Nama Lengkap <span className="text-red-700">*</span></span>
                                <input
                                    type="text"
                                    {...register("nama")}
                                    placeholder="Masukan Nama..."
                                    className={`bg-white border w-full px-4 py-2 text-[15px] rounded focus:border-[#003B65] focus:ring-1 focus:ring-[#003B65] outline-none ${errors.nama ? "border-red-500" : "border-gray-300"}`}
                                />
                                {errors.nama && <span className="text-xs text-red-500">{errors.nama.message}</span>}
                            </div>

                            <div className="flex flex-col gap-2">
                                <span className="text-[20px] font-semibold">Email <span className="text-red-700">*</span></span>
                                <input
                                    type="email"
                                    {...register("email")}
                                    placeholder="Masukan Email..."
                                    className={`bg-white border w-full px-4 py-2 text-[15px] rounded focus:border-[#003B65] focus:ring-1 focus:ring-[#003B65] outline-none ${errors.email ? "border-red-500" : "border-gray-300"}`}
                                />
                                {errors.email && <span className="text-xs text-red-500">{errors.email.message}</span>}
                            </div>

                            <div className="flex flex-col gap-2">
                                <span className="text-[20px] font-semibold">Nomor Handphone <span className="text-red-700">*</span></span>
                                <input
                                    type="text"
                                    {...register("noHp")}
                                    placeholder="+62"
                                    className={`bg-white border w-full px-4 py-2 text-[15px] rounded focus:border-[#003B65] focus:ring-1 focus:ring-[#003B65] outline-none ${errors.noHp ? "border-red-500" : "border-gray-300"}`}
                                />
                                {errors.noHp && <span className="text-xs text-red-500">{errors.noHp.message}</span>}
                            </div>

                            <div className="flex flex-col gap-2">
                                <span className="text-[20px] font-semibold">Pesan<span className="text-red-700">*</span></span>
                                <textarea
                                    {...register("pesan")}
                                    placeholder="Tuliskan Pesan anda..."
                                    className={`bg-white border w-full h-32 md:h-50 px-4 py-2 text-[15px] rounded resize-none focus:border-[#003B65] focus:ring-1 focus:ring-[#003B65] outline-none ${errors.pesan ? "border-red-500" : "border-gray-300"}`}
                                ></textarea>
                                {errors.pesan && <span className="text-xs text-red-500">{errors.pesan.message}</span>}
                            </div>

                            <div className="py-2 flex justify-start">
                                <ReCAPTCHA
                                    ref={recaptchaRef}
                                    sitekey={process.env.NEXT_PUBLIC_RECAPTCHA_SITE_KEY || ""}
                                />
                            </div>

                            <div className="flex items-center">
                                <button 
                                    type="submit" 
                                    disabled={status === "loading"}
                                    className="bg-[#003B65] hover:bg-[#00528A] disabled:bg-gray-400 rounded-lg px-10 py-3 text-[15px] font-semibold text-white cursor-pointer transition-all duration-200"
                                >
                                    {status === "loading" ? "Submitting..." : "Submit"}
                                </button>
                            </div>
                        </motion.form>
                    </div>

                    <motion.div
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8, delay: 0.6 }}
                        className="w-full mx-auto px-8 md:px-16 lg:px-24 pb-10">
                        <div className="w-full h-64 md:h-80 lg:h-96 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.5812996017207!2d106.91652907475724!3d-6.9447556930553445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848036263cdf3%3A0xbf7b17223ca4c4!2sPT%20Silga%20Perkasa!5e1!3m2!1sid!2sid!4v1782372115654!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>
                </section>
            </div>
        )
}