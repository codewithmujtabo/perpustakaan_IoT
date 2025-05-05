<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'rfid_tag',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'id_buku');
    }

    public function isAvailable()
    {
        return $this->stok > 0;
    }
}
