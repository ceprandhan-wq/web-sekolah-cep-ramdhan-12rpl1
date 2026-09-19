<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Daftar akun admin yang harus selalu ada di database.
     * Tambahkan/edit di sini kalau butuh admin lebih dari satu.
     */
    public function run(): void
    {
        $admins = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@smkn1cijati.id',
                'password' => 'ubah-password-ini', // ganti sebelum deploy ke production
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name'     => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'level'    => 'admin',
                ]
            );
        }

        $this->command->info('✅ Akun admin dipastikan ada (dibuat/diupdate).');
    }
}