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
            'name' => 'AAA',
            'email' => 'example@gmail.com',
            'password' => Hash::make('superadmin'),
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'email_verified_at' => date("Y-m-d"),
                'password' => Hash::make('password'),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('markets')->insert([
                'name' => Str::random(5),
                'position' => Str::random(5),
                'note' => Str::random(5),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('transport_companies')->insert([
                'name' => Str::random(5),
                'position' => Str::random(5),
                'note' => Str::random(5),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('pastorals')->insert([
                'name' => Str::random(5),
                'position' => Str::random(5),
                'note' => Str::random(5),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('slaughter_houses')->insert([
                'name' => Str::random(5),
                'position' => Str::random(5),
                'note' => Str::random(5),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);

            DB::table('parts')->insert([
                'name' => Str::random(5),
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d"),
            ]);
        }

        DB::table('roles')->insert([
            'name' => 'admin',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'purchase',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'transport',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'fatten',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'ship',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'slaughter',
            'created_at' => date("Y-m-d"),
            'updated_at' => date("Y-m-d"),
        ]);

        DB::table('roles')->insert([
            'name' => 'meat',
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
