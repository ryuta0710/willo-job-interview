<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Field;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'main_company_id' => '1',
            'phone' => '123456789',
            'period_start' => '2023-09-01',
            'period_end' => '2023-10-05',
            'users_count' => '1',
            'interviews_count' => '0',
            'total_interviews' => '1000',
            'total_sms' => '100',
            'sms_count' => '0',
        ]);
    }
}
