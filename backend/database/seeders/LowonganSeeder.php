<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u = \App\Models\User::first();
        if (!$u) {
            $u = \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password')
            ]);
        }

        \App\Models\Lowongan::create([
            'user_id' => $u->id, 
            'title' => 'Software Engineer', 
            'category' => 'IT', 
            'location' => 'Jakarta Raya', 
            'employment_type' => 'full_time', 
            'description' => 'Membangun aplikasi web yang luar biasa menggunakan Laravel. Bekerja dengan tim dinamis dan remote.', 
            'qualification' => 'Pengalaman minimal 2 tahun. Menguasai PHP.', 
            'deadline' => '2026-12-31', 
            'status' => 'published'
        ]);

        \App\Models\Lowongan::create([
            'user_id' => $u->id, 
            'title' => 'UI/UX Designer', 
            'category' => 'Design', 
            'location' => 'Bandung', 
            'employment_type' => 'freelance', 
            'description' => 'Mencari desainer untuk UI modern dan user friendly. Harus paham alur UX yang baik dan bisa memahami semua tools dan desain yang di kerjakan', 
            'qualification' => 'Pengalaman dengan Figma.', 
            'deadline' => '2026-10-15', 
            'status' => 'published'
        ]);
    }
}
