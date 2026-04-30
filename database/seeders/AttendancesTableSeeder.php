<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::first()->id;
        $today = Carbon::today();

        $records = [];

        // Generate 10 weeks of attendance for each of the 7 modules
        for ($moduleId = 1; $moduleId <= 7; $moduleId++) {
            for ($week = 9; $week >= 0; $week--) {
                $date = $today->copy()->subWeeks($week);

                // Mostly present, occasional absent/late
                $rand = rand(1, 10);
                $status = $rand <= 7 ? 'present' : ($rand === 8 ? 'late' : 'absent');

                $records[] = [
                    'user_id'    => $userId,
                    'module_id'  => $moduleId,
                    'date'       => $date->format('Y-m-d'),
                    'status'     => $status,
                    'created_at' => Carbon::now(),
                ];
            }
        }

        DB::table('attendances')->insert($records);
    }
}
