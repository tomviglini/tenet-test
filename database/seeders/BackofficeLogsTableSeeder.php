<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BackofficeLog;

class BackofficeLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->seed(4);
        $now = Carbon::now()->startOfDay()->subMonth(2);

        for($acc = 1; $acc <= 2; $acc++) {
            $date = $now->copy();
            $logs = [];
            for($day = 0; $day < 60; $day++) {
                if ($faker->numberBetween(1, 3) === 1) {
                    $date->addDay();
                    continue;
                }
                $logs[] = [
                    'account_id' => $acc,
                    'created_at' => $date->toDateTimeString()
                ];
                $date->addDay();
            }
            BackofficeLog::insert($logs);
        }
    }
}
