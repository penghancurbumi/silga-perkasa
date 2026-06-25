import { NextResponse } from "next/server"
import { Resend } from "resend"
import { z } from "zod"

// Inisialisasi Resend (bisa throw error jika key kosong, jadi kita beri fallback sementara)
const resend = new Resend(process.env.RESEND_API_KEY || "missing_key")

// Schema validasi server-side
const contactSchema = z.object({
    nama: z.string().min(2).max(100),
    email: z.string().email(),
    noHp: z.string().min(9).max(15),
    pesan: z.string().min(10).max(1000),
    recaptchaToken: z.string().optional(),
})

// Verifikasi reCAPTCHA
async function verifyRecaptcha(token: string): Promise<boolean> {
    const res = await fetch("https://www.google.com/recaptcha/api/siteverify", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `secret=${process.env.RECAPTCHA_SECRET_KEY}&response=${token}`,
    })
    const data = await res.json()
    // v2 reCAPTCHA hanya mengembalikan 'success', tidak memiliki 'score'
    return data.success === true
}

// Rate limiting sederhana (in-memory, ganti dengan Redis untuk production)
const rateLimitMap = new Map<string, { count: number; timestamp: number }>()

function checkRateLimit(ip: string): boolean {
    const now = Date.now()
    const windowMs = 15 * 60 * 1000 // 15 menit
    const maxRequests = 5

    const record = rateLimitMap.get(ip)
    if (!record || now - record.timestamp > windowMs) {
        rateLimitMap.set(ip, { count: 1, timestamp: now })
        return true
    }
    if (record.count >= maxRequests) return false
    record.count++
    return true
}

export async function POST(request: Request) {
    try {
        if (!process.env.RESEND_API_KEY || process.env.RESEND_API_KEY === "missing_key") {
            return NextResponse.json(
                { error: "API Key Resend belum diatur di file .env.local" },
                { status: 500 }
            )
        }

        // Rate limiting
        const ip = request.headers.get("x-forwarded-for") ?? "unknown"
        if (!checkRateLimit(ip)) {
            return NextResponse.json(
                { error: "Terlalu banyak permintaan. Coba lagi dalam 15 menit." },
                { status: 429 }
            )
        }

        const body = await request.json()

        // Validasi input
        const parsed = contactSchema.safeParse(body)
        if (!parsed.success) {
            return NextResponse.json(
                { error: "Data tidak valid", details: parsed.error.flatten() },
                { status: 400 }
            )
        }

        const { nama, email, noHp, pesan, recaptchaToken } = parsed.data

        // Verifikasi reCAPTCHA (jika token tersedia)
        if (recaptchaToken) {
            const isHuman = await verifyRecaptcha(recaptchaToken)
            if (!isHuman) {
                return NextResponse.json(
                    { error: "Verifikasi reCAPTCHA gagal." },
                    { status: 403 }
                )
            }
        }

        // Kirim email via Resend
        const { error: resendError } = await resend.emails.send({
            from: "Contact Form <onboarding@resend.dev>",
            to: ["m.alfakhreza@gmail.com"],
            replyTo: email,
            subject: `Pesan baru dari ${nama}`,
            html: `<!DOCTYPE html>
                <html>
                <head>
                <meta charset="utf-8">
                </head>
                <body style="font-family: sans-serif; line-height: 1.5; color: #333;">
                <h2>Pesan Baru dari Form Kontak</h2>
                <table style="border-collapse:collapse;width:100%;max-width:600px;">
                    <tr><td style="padding:10px;border:1px solid #ddd;background-color:#f9f9f9;width:30%;"><strong>Nama</strong></td><td style="padding:10px;border:1px solid #ddd">${nama}</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;background-color:#f9f9f9;"><strong>Email</strong></td><td style="padding:10px;border:1px solid #ddd">${email}</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;background-color:#f9f9f9;"><strong>No. HP</strong></td><td style="padding:10px;border:1px solid #ddd">${noHp}</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;background-color:#f9f9f9;"><strong>Pesan</strong></td><td style="padding:10px;border:1px solid #ddd">${pesan}</td></tr>
                </table>
                </body>
                </html>`,
        })

        if (resendError) {
            return NextResponse.json({ error: `Gagal mengirim email: ${resendError.message}` }, { status: 500 })
        }

        // Kirim email konfirmasi ke pengirim
        // Note: Unless email is verified or Resend is upgraded, you can't send to arbitrary emails from onboarding@resend.dev!
        // So we will try-catch it to avoid failing the whole request.
        try {
            await resend.emails.send({
                from: "PT Silga Perkasa <onboarding@resend.dev>",
                to: [email],
                subject: "Pesan Anda telah kami terima",
                html: `<!DOCTYPE html>
                    <html>
                    <head>
                    <meta charset="utf-8">
                    </head>
                    <body style="font-family: sans-serif; line-height: 1.5; color: #333;">
                    <p>Halo <strong>${nama}</strong>,</p>
                    <p>Terima kasih telah menghubungi kami. Tim kami akan segera merespons pesan Anda.</p>
                    <br>
                    <p>Salam hangat,<br/><strong>PT Silga Perkasa</strong></p>
                    </body>
                    </html>`,
            })
        } catch (ignoredError) {
            // Abaikan jika gagal mengirim ke email pengunjung
        }

        return NextResponse.json({ success: true })
    } catch (error) {
        console.error("Contact form error:", error)
        return NextResponse.json({ error: "Terjadi kesalahan server." }, { status: 500 })
    }
}