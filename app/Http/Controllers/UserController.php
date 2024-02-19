<?php

namespace App\Http\Controllers;

use App\Models\StorageLog;

class UserController
{
    public function index()
    {
        return StorageLog::cost(1)->get();

        // $now = Carbon::now()->startOfMinute()->subMonth(1);

        // $storageLogs = [];
        // for($i = 0; $i < 5; $i++) {
        //     $storageLogs[] = [
        //         'created_at' => $now->toDateTimeString()
        //     ];
        //     $now->addMinute();
        // }

        // return $storageLogs;
    }
}
