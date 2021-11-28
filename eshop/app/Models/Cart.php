<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table ='carts';
    protected $fillable=[
        'user_id',
        'pro_id',
        'pro_qty',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class, 'pro_id','id');
    }
}
