<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    /** @use HasFactory<\Database\Factories\RepaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'debt_id',
        'amount',
        'payment_date',
        'notes',
    ];

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
