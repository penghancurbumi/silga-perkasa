import Navbar from "@/component/navbar";
import Footer from "@/component/footer";
import { Roboto } from "next/font/google";
import "./globals.css";

const roboto = Roboto({
  subsets: ["latin"],
  weight: ["300", "400", "500", "700"],
})

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html>
      <body className={roboto.className}>
        <Navbar />
        {children}
        <Footer/>
      </body>
    </html>
  )
}