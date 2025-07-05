<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = ['nama', 'no_hp', 'tanggal', 'jam', 'jumlah_orang', 'meja_id', 'catatan'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function meja()
    {
        return $this->belongsTo('App\Models\Meja');
    }
}
