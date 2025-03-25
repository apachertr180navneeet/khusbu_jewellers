<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderProductImage extends Model
{
    use HasFactory , SoftDeletes;


     // Table name (optional, if different from plural model name)
     protected $table = 'order_product_image';

     // Mass assignable fields
     protected $fillable = [
         'order_id',
         'order_product_id',
         'product_image'
    ];
}
