<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = ['nama', 'kategori_id', 'harga', 'foto', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
