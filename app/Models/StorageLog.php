<?php

namespace App\Models;

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

    public function scopeCost($query, $accountId) {
        return $query
            ->select('account_id', DB::raw('SUM(size_mb / 1024 * 0.03 / 43200) as cost'))
            ->groupBy('account_id')
            ->where('account_id', $accountId);
    }
}
