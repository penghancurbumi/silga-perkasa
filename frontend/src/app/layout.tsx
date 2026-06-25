import Navbar from "@/component/navbar";
import Footer from "@/component/footer";
import { Roboto } from "next/font/google";
import type { Metadata } from "next"
import "./globals.css";

const roboto = Roboto({
  subsets: ["latin"],
  weight: ["300", "400", "500", "700"],
})


export const metadata: Metadata = {
    title:"PT Silga Perkasa | Trusted Broiler Breeding Company Since 1985",
    description:"PT Silga Perkasa adalah perusahaan breeding broiler yang menghasilkan DOC berkualitas tinggi sejak 1985."
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="id">
      <body className={roboto.className}>
        <Navbar />
        {children}
        <Footer/>
      </body>
    </html>
  )
}