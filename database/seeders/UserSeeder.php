<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vô hiệu hóa kiểm tra khóa ngoại để truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Role::truncate();
        DB::table('user_role')->truncate(); // Xóa dữ liệu bảng pivot
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Tạo các vai trò
        $roleNames = ['admin', 'user', 'editor', 'viewer', 'moderator'];
        $roles = [];
        foreach ($roleNames as $name) {
            $roles[$name] = Role::create(['name' => $name]);
        }

        // Tạo người dùng admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin789@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10)
        ]);

        // Gán vai trò admin cho người dùng admin
        $admin->roles()->attach($roles['admin']->id);

        // Tạo 99 người dùng khác
        for ($i = 1; $i < 100; $i++) {
            $user = User::create([
                'name' => 'user' . $i,
                'email' => 'lmp' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10)
            ]);

            // Gán 1 hoặc 2 vai trò ngẫu nhiên
            $randomRoles = collect($roles)->random(rand(1, 2))->pluck('id')->toArray();
            $user->roles()->attach($randomRoles);
        }
    }
}