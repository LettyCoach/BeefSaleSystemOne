<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'example@gmail.com',
            'password' => Hash::make('superadmin'),
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => '一般利用者' . ($i + 1),
                'email' => Str::random(10).'@gmail.com',
                'email_verified_at' => date("Y-m-d"),
                'password' => Hash::make('password'),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('markets')->insert([
                'name' => '市場名' . ($i + 1),
                'position' => '市場位置' . ($i + 1),
                'note' => 'メモ' . ($i + 1),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('transport_companies')->insert([
                'name' => '運送会社名' . ($i + 1),
                'position' => '運送会社位置' . ($i + 1),
                'note' => 'メモ' . ($i + 1),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('pastorals')->insert([
                'name' => '牧場名' . ($i + 1),
                'position' => '牧場位置' . ($i + 1),
                'note' => 'メモ' . ($i + 1),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('slaughter_houses')->insert([
                'name' => '屠殺場名' . ($i + 1),
                'position' => '屠殺場位置' . ($i + 1),
                'note' => 'メモ' . ($i + 1),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);
        }

        DB::table('parts')->insert([
            'name' => '部品1',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);
        DB::table('parts')->insert([
            'name' => '部品2',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);
        DB::table('parts')->insert([
            'name' => '部品3',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'showName' => '',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'purchase',
            'showName' => '購入管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'transport',
            'showName' => '輸送管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'fatten',
            'showName' => '肥育管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'ship',
            'showName' => '出荷管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'slaughter',
            'showName' => '屠殺管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'meat',
            'showName' => '精肉管理',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('role_users')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);
    }
}
