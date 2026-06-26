"use client"

import Image from "next/image"
import { Icon } from "@iconify/react"
import { motion } from "framer-motion"

export default function Location() {
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
                    <span className="font-medium text-6xl text-white">Location</span>
                </motion.div>
            </section>

            <section className="bg-white py-14 md:py-16">
                <div className="w-full mx-auto px-8 md:px-16 lg:px-24 mb-12 flex flex-col gap-16 md:gap-24">
                    
                    {/* Lokasi 1 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 border-b border-gray-200 pb-4"
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT Silga Perkasa</h1>
                                <p className="text-[15px] text-gray-500">Kantor Pusat dan Fasilitas Distribusi Utama</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Pelabuhan II No.385, Dayeuhluhur, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43134</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">(0266) 225580</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Jumat (08:00 - 17:00 WIB)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/LknkE8r3qUuQp42k8" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.5812996017207!2d106.91652907475724!3d-6.9447556930553445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848036263cdf3%3A0xbf7b17223ca4c4!2sPT%20Silga%20Perkasa!5e1!3m2!1sid!2sid!4v1782372115654!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 2 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 border-b border-gray-200 pb-10"
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa (Hatchery Plant)</h1>
                                <p className="text-[15px] text-gray-500">Fasilitas Penetasan Telur Berteknologi Modern</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Lkr. Sukabumi, Gedongpanjang, Kec. Citamiang, Kota Sukabumi, Jawa Barat 43144</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Sabtu (07:00 - 16:00 WIB)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/wSz8EDpPTYN1rj9s9" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.5812996017207!2d106.91652907475724!3d-6.9447556930553445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6848036263cdf3%3A0xbf7b17223ca4c4!2sPT%20Silga%20Perkasa!5e1!3m2!1sid!2sid!4v1782372115654!5m2!1sid!2sidhttps://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.5709769479736!2d106.93185677475728!3d-6.946045393054113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684960f90eb617%3A0x2b01a3ee4f1f8634!2sPT.%20Silga%20Perkasa%20(Hatchery%20Plant)!5e1!3m2!1sid!2sid!4v1782444386463!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                     {/* Lokasi 3 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Nangrang 1</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Kubang Lapang II, Lembursitu, Kec. Lembursitu, Kota Sukabumi, Jawa Barat 43169</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/42txswoH5Hr3ZeMY9" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.388432079761!2d106.88189427475756!3d-6.968813093031793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68383c45550325%3A0xe559b32338edfc99!2sPt%20Silga%20Perkasa%20Farm%201Sukabumi%20(drh%20Ellen)!5e1!3m2!1sid!2sid!4v1782444106492!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 4 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Nangrang 2</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Kubang Lapang II, Lembursitu, Kec. Lembursitu, Kota Sukabumi, Jawa Barat 43169</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/42txswoH5Hr3ZeMY9" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.388432079761!2d106.88189427475756!3d-6.968813093031793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68383c45550325%3A0xe559b32338edfc99!2sPt%20Silga%20Perkasa%20Farm%201Sukabumi%20(drh%20Ellen)!5e1!3m2!1sid!2sid!4v1782444106492!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                     {/* Lokasi 5 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Cpks 1</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Kadu Gede, Cimangkok, Kec. Sukalarang, Kabupaten Sukabumi, Jawa Barat 43191</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/YPxnXi5tW655DjZM8" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2167.331806668993!2d107.0103500712303!3d-6.875778898146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684fe5753d288b%3A0x1f5737718dfcdfd3!2sMitra%20Perkasa%20Farm!5e1!3m2!1sid!2sid!4v1782444593155!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 6 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Cpks 2</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Kadu Gede, Cimangkok, Kec. Sukalarang, Kabupaten Sukabumi, Jawa Barat 43191</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/YPxnXi5tW655DjZM8" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2167.331806668993!2d107.0103500712303!3d-6.875778898146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684fe5753d288b%3A0x1f5737718dfcdfd3!2sMitra%20Perkasa%20Farm!5e1!3m2!1sid!2sid!4v1782444593155!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 7 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Cpks 3</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Kadu Gede, Cimangkok, Kec. Sukalarang, Kabupaten Sukabumi, Jawa Barat 43191</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/YPxnXi5tW655DjZM8" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2167.331806668993!2d107.0103500712303!3d-6.875778898146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684fe5753d288b%3A0x1f5737718dfcdfd3!2sMitra%20Perkasa%20Farm!5e1!3m2!1sid!2sid!4v1782444593155!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>
                
                {/* Lokasi 8 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Titisan</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Titisan Goalpara, Titisan, Kec. Sukalarang, Kabupaten Sukabumi, Jawa Barat 43191</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/ZTBdoBKUfA8pUszK7" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.1795627122706!2d107.02056917475646!3d-6.869597793129058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e684fcc5a1c8abd%3A0x70edd8e3fdb5571f!2sFarm%20titisan!5e1!3m2!1sid!2sid!4v1782445085699!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 9 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Pangantolan</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">XRV6+M6X, Parakanlima, Cikembar, Sukabumi Regency, West Java 43157</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/aTaeyT6gGKj6vQkR9" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1882.2560361372389!2d106.80955403639608!3d-7.005951674166722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e683ba1adf545e3%3A0x2282bbf315ff1b63!2sPangantolan%20Farm!5e1!3m2!1sen!2sid!4v1782445298383!5m2!1sen!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                    {/* Lokasi 9 */}
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        transition={{ duration: 0.8 }}
                        className="grid grid-cols-1 md:grid-cols-2 items-center gap-8 md:gap-12 "
                    >
                        {/* Kiri: Informasi */}
                        <div className="flex flex-col gap-5">
                            <div>
                                <h1 className="text-3xl font-medium mb-1">PT. Silga Perkasa Farm Cibaregbeg</h1>
                                <p className="text-[15px] text-gray-500">Area Peternakan Budi Daya Ayam</p>
                            </div>

                            <div className="flex flex-col gap-4">
                                <div className="flex flex-row gap-4 items-start">
                                    <Icon icon="famicons:location-outline" className="w-8 h-8 text-[#003B65] shrink-0 mt-0.5" />
                                    <p className="text-lg font-base text-gray-500">Jl. Cilimus, Cibaregbeg, Kec. Sagaranten, Kabupaten Sukabumi, Jawa Barat 43181</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-phone" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">-</p>
                                </div>
                                <div className="flex flex-row gap-4 items-center">
                                    <Icon icon="ic:outline-access-time" className="w-8 h-8 text-[#003B65] shrink-0" />
                                    <p className="text-lg font-base text-gray-500">Senin - Minggu (24 Jam)</p>
                                </div>
                            </div>

                            <a href="https://maps.app.goo.gl/LySg29hkvbuiUjyG8" target="_blank" rel="noopener noreferrer" className="flex items-center gap-2 bg-[#003B65] text-white px-5 py-2.5 rounded-lg w-fit hover:bg-[#002b4a] transition-colors mt-2 shadow-sm">
                                <Icon icon="mdi:google-maps" className="w-5 h-5" />
                                <span className="text-[15px] font-medium">Buka di Google Maps</span>
                            </a>
                        </div>

                        {/* Kanan: Map */}
                        <div className="w-full h-64 lg:h-80 rounded-xl overflow-hidden border border-gray-200 shadow">
                            <iframe title="PT Silga Perkasa Location 2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1881.3904010705744!2d106.87310890899377!3d-7.166215304449864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6814fc8997d4bb%3A0xbaa3ee5e7b1d8767!2sJl.%20Cilimus%2C%20Cibaregbeg%2C%20Kec.%20Sagaranten%2C%20Kabupaten%20Sukabumi%2C%20Jawa%20Barat%2043181!5e1!3m2!1sid!2sid!4v1782445997111!5m2!1sid!2sid"
                                className="w-full h-full border-0" loading="lazy"></iframe>
                        </div>
                    </motion.div>

                </div>
            </section>
        </div>
    )
}