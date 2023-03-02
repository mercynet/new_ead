<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    protected $fillable = [
        'active',
        'symbol_first',
        'order',
        'name',
        'code',
        'symbol',
        'precision',
        'thousands',
        'decimal',
    ];
}
