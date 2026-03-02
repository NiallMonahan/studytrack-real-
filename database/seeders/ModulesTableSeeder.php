<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('modules')->insert([
            ['code' => 'CS101', 'title' => 'Intro to Computer Science', 'description' => 'Basics of CS', 'created_at' => $now],
            ['code' => 'MATH201', 'title' => 'Calculus I', 'description' => 'Differential calculus', 'created_at' => $now],
        ]);
    }
}
