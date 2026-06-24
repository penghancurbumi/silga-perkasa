"use client"
import Link from "next/link";
import Image from "next/image";
import { Icon } from "@iconify/react";

export default function Footer() {
    return (
        <footer className="bg-[#003B65] w-full">
            <div className="px-8 md:px-14 lg:px-24 py-12 md:py-16">
                <div className="flex flex-cols md:flex flex-row justify-between gap-10 md:gap-8">

                    {/* Brand Column */}
                    <div className="flex flex-col gap-2 md:max-w-sm">
                        <Image
                            src="/images/white-logo.png"
                            alt="logo icon"
                            width={180}
                            height={36}
                        />

                        <p className="text-sm text-gray-400 mt-4 leading-relaxed">
                            PT Silga Perkasa adalah perusahaan breeding broiler yang telah berdiri sejak tahun 1985 dengan komitmen menghasilkan DOC berkualitas tinggi melalui standar mutu, inovasi, dan pelayanan terbaik.
                        </p>

                        <div className="flex space-x-4 mt-6">
                            <a href="https://www.instagram.com/maxgym.performance/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                                className="text-white/70 hover:text-white transition-colors">
                                <Icon icon="mdi:instagram" className="w-5 h-5" />
                            </a>
                            <a href="https://api.whatsapp.com/send/?phone=%2B6281563447530&text&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer" aria-label="Email"
                                className="text-white/70 hover:text-white transition-colors">
                                <Icon icon="mdi:email-outline" className="w-5 h-5" />
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                                className="text-white/70 hover:text-white transition-colors">
                                <Icon icon="mdi:facebook" className="w-5 h-5" />
                            </a>
                        </div>
                    </div>

                    <div className="flex flex-col md:flex-row gap-10 md:gap-16">

                        {/* Company Column */}
                        <div>
                            <h3 className="font-semibold text-[15px] text-white">Company</h3>
                            <div className="flex flex-col mt-4 gap-2">
                                <Link href="/" className="text-sm text-gray-400 hover:text-white transition-colors">Home</Link>
                                <Link href="/career" className="text-sm text-gray-400 hover:text-white transition-colors">Career</Link>
                                <Link href="/about" className="text-sm text-gray-400 hover:text-white transition-colors">About Us</Link>
                                <Link href="/contact" className="text-sm text-gray-400 hover:text-white transition-colors">Contact</Link>
                                <Link href="/blog" className="text-sm text-gray-400 hover:text-white transition-colors">Blog</Link>
                            </div>
                        </div>

                        {/* Products Column */}
                        <div>
                            <h3 className="font-semibold text-[15px] text-white">Products</h3>
                            <div className="flex flex-col mt-4 gap-2">
                                <span className="text-sm text-gray-400">DOC Broiler</span>
                                <span className="text-sm text-gray-400">Hatching Eggs</span>
                                <span className="text-sm text-gray-400">Parent Stock</span>
                            </div>
                        </div>

                        {/* Contact Column */}
                        <div>
                            <h3 className="font-semibold text-[15px] text-white">Contact</h3>
                            <div className="flex flex-col mt-4 gap-3">
                                <div className="flex items-start gap-2">
                                    <Icon icon="mdi:map-marker-outline" className="w-4 h-4 text-gray-400 mt-0.5 shrink-0" />
                                    <span className="text-sm text-gray-400">Indonesia</span>
                                </div>
                                <div className="flex items-start gap-2">
                                    <Icon icon="mdi:phone-outline" className="w-4 h-4 text-gray-400 mt-0.5 shrink-0" />
                                    <span className="text-sm text-gray-400">+62 815-6344-7530</span>
                                </div>
                                <div className="flex items-start gap-2">
                                    <Icon icon="mdi:email-outline" className="w-4 h-4 text-gray-400 mt-0.5 shrink-0" />
                                    <span className="text-sm text-gray-400">info@silgaperkasa.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Copyright Bar */}
            <div className="border-t border-white/10">
                <div className="px-8 md:px-16 lg:px-24 py-5 flex flex-col md:flex-row items-center justify-between gap-2">
                    <p className="text-xs text-gray-500">&copy; {new Date().getFullYear()} PT Silga Perkasa. All rights reserved.</p>
                    <p className="text-xs text-gray-500">Building Quality Poultry for a Better Future</p>
                </div>
            </div>
        </footer>
    )
}