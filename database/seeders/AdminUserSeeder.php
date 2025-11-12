<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = env('ADMIN_NAME');
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            // minimal change.
            $this->command?->warn('ADMIN_EMAIL o ADMIN_PASSWORD no están configurados.');
            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name ?? 'Administrador',
                'nombre' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
                'profile_locked' => true,
            ]
        );
        // minimal change.
        $this->command?->info('Usuario administrador creado/actualizado.');
    }
}
