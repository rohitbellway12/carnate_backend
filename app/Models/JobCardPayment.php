<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardPayment extends Model
{
    use HasFactory;

    protected $table = 'job_card_payments';

    protected $fillable = [
        'job_card_id',
        'amount',
        'payment_type',
        'transaction_number',
    ];

    public function jobCard()
    {
        return $this->belongsTo(JobCard::class, 'job_card_id');
    }
}
