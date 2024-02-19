<?php

namespace App\Services;

use App\Models\StorageLog;
use App\Models\ProxyLog;
use App\Models\SpeechTranslationLog;
use App\Models\BackofficeLog;

class BillingService
{
    public static function getAllBillings($accountId)
    {
        $services = [];
        $total = 0;

        $services[] = [
            'desc' => 'Storage',
            'cost' => StorageLog::lastMonthBilling($accountId)->first()->cost
        ];
        $services[] = [
            'desc' => 'Proxy',
            'cost' => ProxyLog::lastMonthBilling($accountId)->first()->cost
        ];
        $services[] = [
            'desc' => 'Speech Translation',
            'cost' => SpeechTranslationLog::lastMonthBilling($accountId)->first()->cost
        ];
        $services[] = [
            'desc' => 'Backoffice',
            'cost' => BackofficeLog::lastMonthBilling($accountId)->first()->cost
        ];

        foreach($services as $service) {
            $total += $service['cost'];
        }

        return [
            'services' => $services,
            'total' => $total
        ];
    }
}
