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
            'HRD & Recruitment',
            'Finance & Accounting',
            'IT & Software',
            'Sales & Marketing',
            'Operations & Logistics',
            'Design & Creative',
            'Customer Service'
        ];

        foreach ($categories as $name) {
            \App\Models\JobCategory::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}
