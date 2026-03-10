<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::firstOrCreate(
            ['email' => 'superadmin@desa.go.id'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('desa123'),
                'role'     => 'super_admin',
            ]
        );
    }
}
