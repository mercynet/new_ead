<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, HasLog, SoftDeletes;

    protected $fillable = [
        'active',
        'name',
        'code',
        'icon',
    ];
}
