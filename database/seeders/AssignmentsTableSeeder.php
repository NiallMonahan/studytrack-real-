<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('assignments')->insert([
            // CS101
            ['module_id' => 1, 'title' => 'Hello World Project',        'description' => 'Build a simple CLI program that takes user input and responds.', 'due_at' => $now->copy()->addDays(5),  'created_at' => $now],
            ['module_id' => 1, 'title' => 'Algorithm Analysis Essay',   'description' => 'Write a 1000-word essay comparing sorting algorithms.', 'due_at' => $now->copy()->addDays(14), 'created_at' => $now],
            ['module_id' => 1, 'title' => 'Data Structures Quiz',       'description' => 'Online quiz covering arrays, stacks, and queues.', 'due_at' => $now->copy()->addDays(2),  'created_at' => $now],

            // MATH201
            ['module_id' => 2, 'title' => 'Limits Problem Set',         'description' => 'Solve problems 1–15 from Chapter 2.', 'due_at' => $now->copy()->addDays(7),  'created_at' => $now],
            ['module_id' => 2, 'title' => 'Derivatives Test',           'description' => 'In-class test covering differentiation rules.', 'due_at' => $now->copy()->addDays(10), 'created_at' => $now],

            // WEB301
            ['module_id' => 3, 'title' => 'Portfolio Website',          'description' => 'Build a personal portfolio site using HTML and CSS.', 'due_at' => $now->copy()->addDays(21), 'created_at' => $now],
            ['module_id' => 3, 'title' => 'JavaScript DOM Lab',         'description' => 'Create an interactive to-do list using vanilla JS.', 'due_at' => $now->copy()->addDays(8),  'created_at' => $now],
            ['module_id' => 3, 'title' => 'Responsive Design Report',   'description' => 'Document your approach to making a site mobile-friendly.', 'due_at' => $now->copy()->subDays(1), 'created_at' => $now],

            // DB202
            ['module_id' => 4, 'title' => 'ER Diagram Assignment',      'description' => 'Design an entity-relationship diagram for a library system.', 'due_at' => $now->copy()->addDays(6),  'created_at' => $now],
            ['module_id' => 4, 'title' => 'SQL Query Lab',              'description' => 'Write 20 SQL queries against the provided sample database.', 'due_at' => $now->copy()->addDays(12), 'created_at' => $now],

            // NET401
            ['module_id' => 5, 'title' => 'OSI Model Presentation',     'description' => 'Prepare a 10-minute group presentation on the OSI layers.', 'due_at' => $now->copy()->addDays(9),  'created_at' => $now],
            ['module_id' => 5, 'title' => 'Wireshark Lab Report',       'description' => 'Capture and analyse network packets, write a lab report.', 'due_at' => $now->copy()->subDays(3), 'created_at' => $now],

            // UI303
            ['module_id' => 6, 'title' => 'User Research Plan',         'description' => 'Design a research plan including user interviews and surveys.', 'due_at' => $now->copy()->addDays(4),  'created_at' => $now],
            ['module_id' => 6, 'title' => 'Figma Prototype',            'description' => 'Build a clickable mid-fidelity prototype for a mobile app.', 'due_at' => $now->copy()->addDays(18), 'created_at' => $now],

            // PHP302
            ['module_id' => 7, 'title' => 'Laravel CRUD App',           'description' => 'Build a full CRUD application using Laravel and MySQL.', 'due_at' => $now->copy()->addDays(16), 'created_at' => $now],
            ['module_id' => 7, 'title' => 'REST API Lab',               'description' => 'Create a RESTful API with authentication using Sanctum.', 'due_at' => $now->copy()->addDays(25), 'created_at' => $now],
        ]);
    }
}
