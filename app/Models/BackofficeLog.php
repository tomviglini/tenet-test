<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BackofficeLog extends Model
{
    protected $table = 'backoffice_logs';

    protected $fillable = [
        'account_id', 'created_at',
    ];

    protected $visible = [
        'account_id', 'created_at', 'cost',
    ];

    public function scopeLastMonthBilling($query, $accountId) {
        $pricePerDay = 7 / 30;
        $now = Carbon::now()->subMonth(1);
        $start = $now->copy()->startOfMonth();
        $end = $now->copy()->endOfMonth();
        return $query
            ->select('account_id', DB::raw("SUM({$pricePerDay}) as cost"))
            ->groupBy('account_id')
            ->where('account_id', $accountId)
            ->where('created_at', '>=', $start)
            ->where('created_at', '<=', $end);
    }
}
