<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class ModulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $userId = User::first()->id;

        DB::table('modules')->insert([
            ['user_id' => $userId, 'code' => 'CS101',   'title' => 'Intro to Computer Science',  'description' => 'Fundamentals of programming, algorithms, and computational thinking.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'MATH201', 'title' => 'Calculus I',                  'description' => 'Differential calculus, limits, and derivatives.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'WEB301',  'title' => 'Web Development',             'description' => 'HTML, CSS, JavaScript and modern front-end frameworks.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'DB202',   'title' => 'Database Systems',            'description' => 'Relational databases, SQL, and data modelling.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'NET401',  'title' => 'Networking Fundamentals',     'description' => 'TCP/IP, OSI model, routing and network security basics.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'UI303',   'title' => 'UI/UX Design',                'description' => 'User research, wireframing, prototyping and accessibility.', 'created_at' => $now],
            ['user_id' => $userId, 'code' => 'PHP302',  'title' => 'Backend Development',         'description' => 'Server-side programming with PHP and Laravel.', 'created_at' => $now],
        ]);
    }
}
