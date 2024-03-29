<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StorageLog extends Model
{
    protected $table = 'storage_logs';

    protected $fillable = [
        'account_id', 'created_at', 'size_mb',
    ];

    protected $visible = [
        'account_id', 'created_at', 'size_mb', 'cost'
    ];

    public function scopeLastMonthBilling($query, $accountId) {
        $pricePerGB = 0.03;
        $now = Carbon::now()->subMonth(1);
        $start = $now->copy()->startOfMonth();
        $end = $now->copy()->endOfMonth();
        return $query
            ->select('account_id', DB::raw("SUM(size_mb / 1024 * {$pricePerGB} / 43200) as cost"))
            ->groupBy('account_id')
            ->where('account_id', $accountId)
            ->where('created_at', '>=', $start)
            ->where('created_at', '<=', $end);
    }
}
