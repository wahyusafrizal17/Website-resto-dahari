<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(\Auth::check() && \Auth::user()->level == 'Admin'){
            return view('admin.welcome');
        }else{
            $transaksis = Transaksi::all();

            $menuCount = [];

            foreach ($transaksis as $trx) {
                if (!$trx->menu) continue;

                $deserialized = @unserialize($trx->menu);

                if (is_array($deserialized)) {
                    foreach (array_keys($deserialized) as $cartId) {
                        $cart = Cart::find($cartId);

                        if ($cart && $cart->menu_id) {
                            $menuId = $cart->menu_id;
                            if (!isset($menuCount[$menuId])) {
                                $menuCount[$menuId] = 0;
                            }
                            $menuCount[$menuId]++;
                        }
                    }
                }
            }

            // Urutkan dari terbanyak
            arsort($menuCount);
            
            // Ambil 3 menu terlaris
            $topMenuCounts = array_slice($menuCount, 0, 3, true);

            // Ambil detail menu berdasarkan ID
            $data['topMenus'] = Menu::whereIn('id', array_keys($topMenuCounts))->get()->keyBy('id');

            return view('website.welcome', $data);
        }
    }

    public function login(Request $request)
    {
        $request->session()->put('auth_nama', $request->nama);
        $request->session()->put('auth_phone', $request->phone);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('auth_nama');
        $request->session()->forget('auth_phone');

        return redirect('/');
    }
    
}
