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
    }
}
