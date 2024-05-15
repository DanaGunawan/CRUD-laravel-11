<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable = ['id_produk','nama_produk','foto_produk','kategori','harga'];
  
    protected $primaryKey = 'id_produk';
    public $incrementing = false; 

    protected $table = 'barangs';
    protected $keyType = 'string'; 
    public $timestamps = false;
}
