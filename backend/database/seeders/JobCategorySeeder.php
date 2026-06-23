<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Executive Management',
            'Hatchery',
            'Farm',
            'Animal Health (Keswan)',
            'Human Resources & General Affairs (HRGA)',
            'Operations',
            'Finance & Accounting',
            'Tax',
            'Marketing & Sales',
            'Purchasing & Procurement',
            'Information Technology (IT)',
            'Maintenance & Engineering',
            'Internal Control',
        ];

        foreach ($categories as $name) {
            \App\Models\JobCategory::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
