<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = ['phone', 'menu_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
