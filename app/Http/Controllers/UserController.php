<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class UserController
{
    public function index()
    {
        $now = Carbon::now()->startOfMinute()->subMonth(1);

        $storageLogs = [];
        for($i = 0; $i < 5; $i++) {
            $storageLogs[] = [
                'created_at' => $now->toDateTimeString()
            ];
            $now->addMinute();
        }

        return $storageLogs;
    }
}
