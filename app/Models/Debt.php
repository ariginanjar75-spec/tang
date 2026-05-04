<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'total_amount',
        'selected_tenor',
        'monthly_installment',
    ];

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function getRemainingBalanceAttribute()
    {
        return $this->total_amount - $this->repayments()->sum('amount');
    }
}
