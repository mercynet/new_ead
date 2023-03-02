<?php

namespace App\Models;

use App\Traits\HasLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMode extends Model
{
    use HasFactory, SoftDeletes, HasLog;

    protected $fillable = [
        'name',
        'path',
        'image',
        'active',
    ];
}
