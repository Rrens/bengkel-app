<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'item_id',
        'customer_id',
        'price',
        'discount_item',
        'total',
        'created_at',
        'updated_at',
    ];

    public function item()
    {
        return $this->hasMany(Product_items::class, 'id', 'item_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
