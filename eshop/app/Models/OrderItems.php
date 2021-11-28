<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    use HasFactory;

    protected $table ='order_items';
    protected $fillable=[
       'order_id',
       'pro_id',
       'price',
       'qty',
    ];
    public function products():BelongsTo
    {
        return $this->belongsTo(Product::class, 'pro_id','id');
    }
}
