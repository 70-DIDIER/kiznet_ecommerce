<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifier si l'utilisateur admin existe déjà
        if (!User::where('pseudo', 'admin')->exists()) {
            $user = User::create([
                'firstname' => 'Admin',
                'lastname' => 'System',
                'pseudo' => 'admin',
                'password' => Hash::make('admin1234'),
                'phone_number' => '+22890000000', // exemple
                'address' => 'Lomé/TOGO',
            ]);

            // Assigner le rôle 'admin' à l'utilisateur
            $user->assignRole('superadmin');

            $this->command->info('Super-Admin user créé avec succès et rôle assigné.');
        } else {
            $this->command->info('L\'utilisateur admin existe déjà.');
        }
    }
}