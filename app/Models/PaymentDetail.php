<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PaymentDetail extends Model
{
    use HasFactory , SoftDeletes;


    // Table name (optional, if different from plural model name)
    protected $table = 'payment_details';

    // Mass assignable fields
    protected $fillable = [
            'order_id',
            'payment_screen_shot',
            'date',
            'paid_amount',
            'payment_via',
            'utr_id',
            'total_amount',
            'adv_amount',
            'cod_amount'
    ];

    public function orderPaymentImages()
    {
        return $this->hasMany(OrderPaymentImage::class, 'order_payment_id', 'id');
    }
}
