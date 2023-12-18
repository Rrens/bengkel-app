<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductItems extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_items';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'barcode',
        'name',
        'category_id',
        'price',
        'stock',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->hasMany(ProductCategory::class, 'id', 'category_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function sale_detail()
    {
        return $this->belongsTo(SaleDetail::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
