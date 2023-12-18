<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penerimaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'penerimaans';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'pembelian_id',
        'jumlah_penerimaan',
        'tanggal_penerimaan',
        'created_at',
        'updated_at'
    ];
}
