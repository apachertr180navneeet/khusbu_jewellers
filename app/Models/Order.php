<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory , SoftDeletes;


     // Table name (optional, if different from plural model name)
     protected $table = 'orders';

     // Mass assignable fields
     protected $fillable = [
         'order_payment_type',
         'delivery_type',
         'order_type',
         'product_founder',
         'customer_id',
         'exicutive_id',
         'sale_manager_id',
         'date',
         'amount',
         'feedback',
         'comment',
         'status'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

}
