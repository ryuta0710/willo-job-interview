<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            ['name' => '会計'],
            ['name' => 'マーケティング、広報'],
            ['name' => '医学'],
            ['name' => '農業'],
            ['name' => 'IT'],
            ['name' => 'セキュリティ'],
            ['name' => '企業'],
            ['name' => '自動車'],
            ['name' => '自動化'],
            ['name' => '電子工業'],
        ];
        Field::factory()->createMany($fields);
    }
}
