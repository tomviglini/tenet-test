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
        $faker->seed(2);
        $now = Carbon::now()->startOfMinute()->subMonth(1);

        for($day = 0; $day < 30; $day++) {
            $storageLogs = [];
            for($i = 0; $i < 60*24; $i++) {
                $storageLogs[] = [
                    'account_id' => 1,
                    'created_at' => $now->toDateTimeString(),
                    'size_mb' => $faker->randomNumber(5, true)
                ];
                $now->addMinute();
            }
            StorageLog::insert($storageLogs);
        }
    }
}
