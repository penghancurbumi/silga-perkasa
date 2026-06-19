<?php
$u = App\Models\User::first();
if (!$u) {
    $u = new App\Models\User();
    $u->name = 'Admin';
    $u->email = 'admin@admin.com';
    $u->password = bcrypt('password');
    $u->save();
}

App\Models\Lowongan::create([
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

App\Models\Lowongan::create([
    'user_id' => $u->id, 
    'title' => 'UI/UX Designer', 
    'category' => 'Design', 
    'location' => 'Bandung', 
    'employment_type' => 'freelance', 
    'description' => 'Mencari desainer untuk UI modern dan user friendly. Harus paham alur UX yang baik.', 
    'qualification' => 'Pengalaman dengan Figma.', 
    'deadline' => '2026-10-15', 
    'status' => 'published'
]);
echo "Seeded successfully!";
