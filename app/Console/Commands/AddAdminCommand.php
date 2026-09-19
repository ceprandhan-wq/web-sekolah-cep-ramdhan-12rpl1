<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddAdminCommand extends Command
{
    protected $signature = 'admin:add {email} {password} {name=Administrator}';

    protected $description = 'Tambah atau update user sebagai admin lewat email';

    public function handle(): int
    {
        $user = User::updateOrCreate(
            ['email' => $this->argument('email')],
            [
                'name'     => $this->argument('name'),
                'password' => Hash::make($this->argument('password')),
                'level'    => 'admin',
            ]
        );

        $this->info("✅ {$user->email} sekarang admin (id: {$user->id}).");

        return self::SUCCESS;
    }
}