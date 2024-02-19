<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpeechTranslationLog extends Model
{
    protected $table = 'speech_translation_logs';

    protected $fillable = [
        'account_id', 'created_at',
    ];

    protected $visible = [
        'account_id', 'created_at',
    ];

    public function scopeLastMonthBilling($query, $accountId) {
        $pricePerTranslation = 0.00003;
        $now = Carbon::now()->subMonth(1);
        $start = $now->copy()->startOfMonth();
        $end = $now->copy()->endOfMonth();
        return $query
            ->select('account_id', DB::raw("SUM({$pricePerTranslation}) as cost"))
            ->groupBy('account_id')
            ->where('account_id', $accountId)
            ->where('created_at', '>=', $start)
            ->where('created_at', '<=', $end);
    }
}
