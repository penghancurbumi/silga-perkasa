<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user
        $u = \App\Models\User::first();
        if (!$u) {
            $u = \App\Models\User::factory()->create([
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Ambil semua kategori dari database (pastikan JobCategorySeeder sudah jalan)
        $categories = \App\Models\JobCategory::all();
        if ($categories->isEmpty()) {
            $this->command->info('Job Categories kosong, menjalankan JobCategorySeeder...');
            $this->call(JobCategorySeeder::class);
            $categories = \App\Models\JobCategory::all();
        }

        $employmentTypes = ['full_time', 'part_time', 'contract', 'internship', 'freelance'];
        $locations = ['Jakarta', 'Surabaya', 'Bandung', 'Yogyakarta', 'Kalimantan', 'Medan', 'Makassar'];
        
        $jobTitles = [
            'Staff Administrasi', 'Manager Operasional', 'Teknisi Farm', 'Dokter Hewan', 
            'Marketing Executive', 'IT Support', 'Software Engineer', 'HR Staff',
            'Akuntan', 'Quality Control', 'Supir Logistik', 'Sales Representative'
        ];

        // Buat 15 lowongan dummy dengan tipe yang berbeda-beda
        for ($i = 0; $i < 15; $i++) {
            $type = $employmentTypes[array_rand($employmentTypes)];
            $cat  = $categories->random();
            $loc  = $locations[array_rand($locations)];
            $title = $jobTitles[array_rand($jobTitles)];
            
            \App\Models\Lowongan::create([
                'user_id'            => $u->id,
                'title'              => $title,
                'job_category_id'    => $cat->id,
                'location'           => $loc,
                'minimum_experience' => rand(0, 5),
                'employment_type'    => $type,
                'description'        => "Dicari seorang $title yang kompeten untuk bekerja secara $type di $loc. Memiliki tanggung jawab penuh dan dedikasi tinggi terhadap perusahaan.",
                'qualification'      => "Minimal pendidikan S1. Pengalaman kerja minimal " . rand(0,3) . " tahun. Mampu bekerja dalam tim.",
                'posted_at'          => now()->subDays(rand(0, 30)),
                'deadline'           => now()->addDays(rand(10, 60)),
                'status'             => rand(1, 10) > 2 ? 'published' : 'draft',
            ]);
        }
    }
}
