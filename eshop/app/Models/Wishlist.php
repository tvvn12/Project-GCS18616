<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Wishlist extends Model
{
    use HasFactory;
    protected $table ='wishlists';
    protected $fillable =[
        'user_id',
        'pro_id',
    ];
    public function products()
    {
        return $this->belongsTo(Product::class, 'pro_id','id');
    }
}
