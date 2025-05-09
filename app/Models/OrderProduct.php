<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderProduct extends Model
{
    use HasFactory , SoftDeletes;


     // Table name (optional, if different from plural model name)
     protected $table = 'order_products';

     // Mass assignable fields
     protected $fillable = [
         'order_id',
         'product_image',
         'product_name',
         'product_price',
         'product_qty',
         'product_type',
         'product_weight',
         'product_date',
         'comment'
    ];

    public function orderProductImages()
    {
        return $this->hasMany(OrderProductImage::class, 'order_product_id', 'id');
    }
}
