<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\StorageLog;

class StorageLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->seed(1);
        $now = Carbon::now()->startOfDay()->subMonth(2);

        for($acc = 1; $acc <= 2; $acc++) {
            $date = $now->copy();
            for($day = 0; $day < 60; $day++) {
                $logs = [];
                for($i = 0; $i < 60*24; $i++) {
                    $logs[] = [
                        'account_id' => $acc,
                        'created_at' => $date->toDateTimeString(),
                        'size_mb' => $faker->randomNumber(5, true) * $acc
                    ];
                    $date->addMinute();
                }
                StorageLog::insert($logs);
            }
        }
    }
}
