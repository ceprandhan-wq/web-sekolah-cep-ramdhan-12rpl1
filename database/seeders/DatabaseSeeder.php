<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            AdminSeeder::class,
            JurusanSeeder::class,          // dulu, karena GuruSeeder butuh jurusan_id
            GuruSeeder::class,             // dulu, karena EkstrakurikulerSeeder butuh id_pembina
            EkstrakurikulerSeeder::class,
            ArtikelSeeder::class,
            FasilitasSeeder::class,
            BerandaSeeder::class,
            SeragamSeeder::class,
            prestasiSeeder::class,
            GaleriVideoSeeder::class,
            ProfilSeeder::class,
            kepalasekolahSeeder::class,
        ]);
    }
}