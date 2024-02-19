<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageLog extends Model
{
    protected $table = 'storage_logs';

    protected $fillable = [
        'account_id', 'created_at', 'size_mb'
    ];

    protected $visible = [
        'account_id', 'created_at', 'size_mb',
    ];
}
