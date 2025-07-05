<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['invoice', 'phone', 'nama', 'meja_id', 'menu', 'status_pembayaran', 'diskon', 'total', 'catatan', 'snap_token'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function meja()
    {
        return $this->belongsTo('App\Models\Meja');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
