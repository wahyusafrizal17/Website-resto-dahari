<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

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
            $data['menus'] = Menu::all();
            return view('website.welcome', $data);
        }
    }

    public function login(Request $request)
    {
        $request->session()->put('nama', $request->nama);
        $request->session()->put('phone', $request->phone);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('nama');
        $request->session()->forget('phone');

        return redirect('/');
    }
    
}
