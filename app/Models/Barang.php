<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barang";

    protected $fillable =[
        'user_id',
        'category_id',
        'nama_produk',
        'path_gambar',
        'harga_beli',
        'harga_jual',
        'stok',
        'barcode',
    ];


}
