<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('assignments')->insert([
            ['module_id' => 1, 'title' => 'Homework 1', 'description' => 'Solve problems 1–10', 'due_at' => $now->copy()->addWeek(), 'created_at' => $now],
            ['module_id' => 2, 'title' => 'Quiz 1', 'description' => 'Limits and derivatives', 'due_at' => $now->copy()->addDays(10), 'created_at' => $now],
        ]);
    }
}
