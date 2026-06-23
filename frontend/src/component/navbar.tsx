"use client"
import Link from "next/link"
import { useState, useEffect } from "react"
import { Icon } from "@iconify/react"

export default function Navbar() {
    const [scrolled, setScrolled] = useState(false)
    const [mobileOpen, setMobileOpen] = useState(false)

    useEffect(() => {
        const handleScroll = () => {
            setScrolled(window.scrollY > 60)
        }
        window.addEventListener("scroll", handleScroll)
        return () => window.removeEventListener("scroll", handleScroll)
    }, [])

    useEffect(() => {
        const handleResize = () => {
            if (window.innerWidth >= 768) setMobileOpen(false)
        }
        window.addEventListener("resize", handleResize)
        return () => window.removeEventListener("resize", handleResize)
    }, [])

    const navItem = [
        { name: "Home", href: "/" },
        { name: "Career", href: "/career" },
        { name: "Blog", href: "/blog" },
        { name: "About Us", href: "/about" },
        { name: "Contact", href: "/contact" },
    ]

    return (
        <nav className={`fixed top-0 w-full z-50 transition-all duration-300 ${scrolled || mobileOpen  // ✅ putih jika scroll ATAU menu terbuka
            ? "bg-white shadow-sm"
            : "bg-transparent"
            }`}>
            <div className="flex items-center justify-between px-8 md:px-16 lg:px-24 h-20 w-full">
                {/* Logo */}
                <img
                    src={scrolled || mobileOpen ? "/images/logo-icon.png" : "/images/white-logo.png"}
                    alt="silga perkasa logo"
                    width={200}
                    height={30}
                />

                {/* Desktop Nav Items */}
                <div className="hidden md:flex items-center gap-8">
                    {navItem.map((item) => (
                        <Link
                            key={item.name}
                            href={item.href}
                            className={`nav text-[18px] font-medium ${scrolled
                                ? "text-black hover:text-blue-800"
                                : "text-white hover:text-gray-300"
                                }`}>
                            {item.name}
                        </Link>
                    ))}
                </div>

                {/* Mobile Hamburger Button */}
                <button
                    className="md:hidden"
                    onClick={() => setMobileOpen(!mobileOpen)}>
                    <Icon
                        icon={mobileOpen ? "mdi:close" : "mdi:menu"}
                        width={30}
                        height={30}
                        color={scrolled || mobileOpen ? "black" : "white"}
                    />
                </button>
            </div>

            {/* Mobile Dropdown Nav Items */}
            <div className={`md:hidden overflow-hidden transition-all duration-300 h-screen
                ${mobileOpen ? "max-h-screen" : "max-h-0"
                }`}>
                <div className={`flex flex-col gap-4 px-8 pb-4 pt-5 transition-all duration-300 
                ${mobileOpen ? "border-t border-gray-100" : "border-none"
                    }`}>
                    {navItem.map((item) => (
                        <Link
                            key={item.name}
                            href={item.href}
                            onClick={() => setMobileOpen(false)}
                            className="nav py-1.5 w-fit text-[18px] font-medium text-black hover:text-blue-600 transition-colors"
                        >
                            {item.name}
                        </Link>
                    ))}
                </div>
            </div>
        </nav>
    )
}