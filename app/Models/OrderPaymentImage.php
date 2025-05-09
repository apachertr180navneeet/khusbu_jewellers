<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderPaymentImage extends Model
{
    use HasFactory , SoftDeletes;


     // Table name (optional, if different from plural model name)
     protected $table = 'payment_image';

     // Mass assignable fields
     protected $fillable = [
         'order_id',
         'order_payment_id',
         'payment_image'
    ];

    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class, 'order_payment_id', 'id');
    }

}
