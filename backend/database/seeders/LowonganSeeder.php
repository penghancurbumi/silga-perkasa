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

        // Pastikan ada job categories
        $categories = [
            ['name' => 'Teknologi Informasi', 'slug' => 'teknologi-informasi'],
            ['name' => 'Desain & Kreatif',    'slug' => 'desain-kreatif'],
            ['name' => 'Pemasaran',            'slug' => 'pemasaran'],
            ['name' => 'Keuangan',             'slug' => 'keuangan'],
            ['name' => 'Operasional',          'slug' => 'operasional'],
        ];

        foreach ($categories as $cat) {
            \App\Models\JobCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name']]
            );
        }

        $itCategory     = \App\Models\JobCategory::where('slug', 'teknologi-informasi')->first();
        $designCategory = \App\Models\JobCategory::where('slug', 'desain-kreatif')->first();

        // Lowongan 1 – Software Engineer
        \App\Models\Lowongan::create([
            'user_id'            => $u->id,
            'title'              => 'Software Engineer',
            'job_category_id'    => $itCategory->id,
            'location'           => 'Jakarta Raya',
            'minimum_experience' => 2,
            'employment_type'    => 'full_time',
            'description'        => 'Membangun aplikasi web yang luar biasa menggunakan Laravel. Bekerja dengan tim dinamis dan remote.',
            'qualification'      => 'Pengalaman minimal 2 tahun. Menguasai PHP dan Laravel.',
            'posted_at'          => now(),
            'deadline'           => '2026-12-31',
            'status'             => 'published',
        ]);

        // Lowongan 2 – UI/UX Designer
        \App\Models\Lowongan::create([
            'user_id'            => $u->id,
            'title'              => 'UI/UX Designer',
            'job_category_id'    => $designCategory->id,
            'location'           => 'Bandung',
            'minimum_experience' => 1,
            'employment_type'    => 'freelance',
            'description'        => 'Mencari desainer untuk UI modern dan user friendly. Harus paham alur UX yang baik dan bisa memahami semua tools dan desain yang dikerjakan.',
            'qualification'      => 'Pengalaman dengan Figma dan Adobe XD minimal 1 tahun.',
            'posted_at'          => now(),
            'deadline'           => '2026-10-15',
            'status'             => 'published',
        ]);

        // Lowongan 3 – Web Designer (draft)
        \App\Models\Lowongan::create([
            'user_id'            => $u->id,
            'title'              => 'Web Designer',
            'job_category_id'    => $designCategory->id,
            'location'           => 'Jakarta',
            'minimum_experience' => 0,
            'employment_type'    => 'full_time',   // diperbaiki dari 'fulltime'
            'description'        => 'Mencari web designer untuk UI modern dan user friendly. Harus paham alur UX yang baik dan bisa memahami semua tools dan desain yang dikerjakan.',
            'qualification'      => 'Pengalaman dengan Figma dan HTML/CSS.',
            'posted_at'          => null,
            'deadline'           => '2027-04-13',
            'status'             => 'draft',
        ]);
    }
}
