<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ImmediateDelivery extends Model
{
    use SoftDeletes;

    protected $table = 'immediate_deliveries';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'state',
        'city',
    ];
    public $timestamp = true;
}
