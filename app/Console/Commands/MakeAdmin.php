<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class MakeAdmin extends Command
{
    protected $signature = 'make:admin';

    protected $description = 'Créer un compte administrateur sécurisé';

    public function handle(): int
    {
        $this->info('');
        $this->info('  ╔══════════════════════════════╗');
        $this->info('  ║   Création d\'un administrateur  ║');
        $this->info('  ╚══════════════════════════════╝');
        $this->info('');

        // Pseudo
        $pseudo = $this->askWithValidation(
            'Pseudo (identifiant de connexion)',
            fn ($v) => Validator::make(['pseudo' => $v], [
                'pseudo' => 'required|string|min:3|max:50|unique:users,pseudo|regex:/^[a-zA-Z0-9_\-]+$/',
            ])->errors()->first('pseudo')
        );

        // Prénom
        $firstname = $this->askWithValidation(
            'Prénom',
            fn ($v) => Validator::make(['firstname' => $v], [
                'firstname' => 'required|string|max:100',
            ])->errors()->first('firstname')
        );

        // Nom
        $lastname = $this->askWithValidation(
            'Nom',
            fn ($v) => Validator::make(['lastname' => $v], [
                'lastname' => 'required|string|max:100',
            ])->errors()->first('lastname')
        );

        // Téléphone (optionnel)
        $phone = $this->ask('Téléphone (optionnel, appuyer Entrée pour ignorer)');
        if ($phone === '') {
            $phone = null;
        }

        // Mot de passe
        $password = $this->askPassword();

        // Confirmation
        $this->info('');
        $this->table(
            ['Champ', 'Valeur'],
            [
                ['Pseudo', $pseudo],
                ['Prénom', $firstname],
                ['Nom', $lastname],
                ['Téléphone', $phone ?? '(aucun)'],
                ['Mot de passe', str_repeat('•', strlen($password))],
            ]
        );

        if (! $this->confirm('Confirmer la création de cet administrateur ?', true)) {
            $this->warn('Annulé.');
            return self::FAILURE;
        }

        // S'assurer que le rôle "admin" existe
        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Créer l'utilisateur
        $user = User::create([
            'firstname'    => $firstname,
            'lastname'     => $lastname,
            'pseudo'       => $pseudo,
            'phone_number' => $phone,
            'password'     => Hash::make($password),
        ]);

        $user->assignRole($role);

        $this->info('');
        $this->info("  ✓ Administrateur « {$pseudo} » créé avec succès.");
        $this->info('');

        return self::SUCCESS;
    }

    private function askWithValidation(string $question, callable $validate): string
    {
        while (true) {
            $value = $this->ask($question);
            $error = $validate($value ?? '');
            if (! $error) {
                return $value;
            }
            $this->error("  ✗ {$error}");
        }
    }

    private function askPassword(): string
    {
        while (true) {
            $password = $this->secret('Mot de passe (min. 8 caractères)');

            $error = Validator::make(['password' => $password], [
                'password' => 'required|min:8',
            ])->errors()->first('password');

            if ($error) {
                $this->error("  ✗ {$error}");
                continue;
            }

            $confirm = $this->secret('Confirmer le mot de passe');

            if ($password !== $confirm) {
                $this->error('  ✗ Les mots de passe ne correspondent pas.');
                continue;
            }

            return $password;
        }
    }
}
