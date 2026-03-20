<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('modules')->insert([
            ['code' => 'CS101',   'title' => 'Intro to Computer Science',  'description' => 'Fundamentals of programming, algorithms, and computational thinking.', 'created_at' => $now],
            ['code' => 'MATH201', 'title' => 'Calculus I',                  'description' => 'Differential calculus, limits, and derivatives.', 'created_at' => $now],
            ['code' => 'WEB301',  'title' => 'Web Development',             'description' => 'HTML, CSS, JavaScript and modern front-end frameworks.', 'created_at' => $now],
            ['code' => 'DB202',   'title' => 'Database Systems',            'description' => 'Relational databases, SQL, and data modelling.', 'created_at' => $now],
            ['code' => 'NET401',  'title' => 'Networking Fundamentals',     'description' => 'TCP/IP, OSI model, routing and network security basics.', 'created_at' => $now],
            ['code' => 'UI303',   'title' => 'UI/UX Design',                'description' => 'User research, wireframing, prototyping and accessibility.', 'created_at' => $now],
            ['code' => 'PHP302',  'title' => 'Backend Development',         'description' => 'Server-side programming with PHP and Laravel.', 'created_at' => $now],
        ]);
    }
}
