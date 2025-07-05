<?php

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Kategori;

function getCountCart()
{
    $model = Cart::where('phone', \Session::get('no_hp'))->where('status', 1)->get();
    return count($model);
}

function getCart($id)
{
    $model = Cart::where('id', $id)->first();

    return $model;
}

function getKategori()
{
    $model = Kategori::all();
    return $model;
}

function getPerhari()
{
    $data = \DB::SELECT("SELECT 
                    SUM(total) AS total
                FROM 
                    transaksi
                WHERE 
                    created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)
                    AND created_at <= DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY)");

    return $data;
}
function getPerminggu()
{
    $data = \DB::SELECT("SELECT 
    SUM(total) AS total
FROM 
    transaksi
WHERE 
    created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 WEEK)
    AND created_at <= DATE_ADD(CURRENT_DATE(), INTERVAL 1 WEEK)");

    return $data;
}

function getPerbulan()
{
    $data = \DB::SELECT("SELECT 
    SUM(total) AS total
FROM 
    transaksi
WHERE 
    created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 MONTH)
    AND created_at <= DATE_ADD(CURRENT_DATE(), INTERVAL 1 MONTH)");

    return $data;
}