<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\Lowongan;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID lowongan yang ada
        $lowonganIds = Lowongan::pluck('id')->toArray();

        if (empty($lowonganIds)) {
            $this->command->info('Tidak ada data Lowongan, lewati seeder Application.');
            return;
        }

        $statuses = ['pending', 'review', 'interview', 'accepted', 'rejected'];
        $sources = ['jobstreet','media sosial','website','poster','other'];
        $genders = ['male', 'female'];

        for ($i = 0; $i < 50; $i++) {
            // 1. Buat Applicant Dummy
            $applicant = Applicant::create([
                'fullname'        => $faker->name(),
                'email'           => $faker->unique()->safeEmail(),
                'phone'           => $faker->phoneNumber(),
                'gender'          => $genders[array_rand($genders)],
                'birth_place'     => $faker->city(),
                'birth_date'      => $faker->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d'),
                'address'         => $faker->streetAddress(),
                'village'         => 'Kelurahan ' . $faker->word(),
                'district'        => 'Kecamatan ' . $faker->word(),
                'city'            => $faker->city(),
                'province'        => $faker->state(),
                'postal_code'     => $faker->postcode(),
                'referral_source' => $sources[array_rand($sources)],
            ]);

            // 2. Buat Application Dummy
            // Acak tanggal lamaran dari 3 bulan lalu sampai hari ini (agar grafik ada isinya)
            $appliedAt = $faker->dateTimeBetween('-3 months', 'now');

            Application::create([
                'applicant_id' => $applicant->id,
                'lowongan_id'  => $lowonganIds[array_rand($lowonganIds)],
                'resume'       => 'resume_' . time() . '.pdf',
                'declaration'  => true,
                'status'       => $statuses[array_rand($statuses)],
                'notes'        => $faker->optional(0.3)->sentence(), // 30% kemungkinan ada notes
                'applied_at'   => $appliedAt,
                'created_at'   => $appliedAt,
                'updated_at'   => $appliedAt,
            ]);
        }
    }
}
