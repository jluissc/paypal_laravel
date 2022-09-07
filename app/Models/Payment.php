<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'date_pay',
        'mount',
        'paymentId',
        'payerID',
        'token',
    ];
}
