<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Cart;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Diskon;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->filter)) {
            $data['model'] = Transaksi::whereMonth('created_at', $request->filter)->get();
        } else {
            $data['model'] = Transaksi::all();
        }
        return view('admin.transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->back()->with('error', 'Tidak diizinkan.');
    }


    public function pesanan()
    {
        $data['model'] = Transaksi::where('phone', Session::get('auth_phone'))->get();
        return view('website.pesanan', $data);
    }

    public function keranjang()
    {
        $data['menus'] = Menu::limit(4)->get();
        $data['model'] = Cart::where('phone', Session::get('auth_phone'))->where('status', 1)->get();
        return view('website.keranjang', $data);
    }

    public function keranjangAdd($id)
    {
        if (!Session::has('auth_phone')) {
            return redirect()->route('view-login');
        }
        $cart = Cart::where('phone', Session::get('auth_phone'))->where('menu_id', $id)->where('status', 1)->first();

        $model = (!empty($cart)) ? $cart : new Cart();
        $model->phone = Session::get('auth_phone');
        $model->menu_id = $id;
        $model->jumlah = (!empty($cart)) ? $cart->jumlah + 1 : 1;
        $model->status = 1;
        $model->save();
        return redirect()->back();
    }

    public function keranjangDelete($id)
    {
        $cart = Cart::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function keranjangCheckout(Request $request)
    {
        $data['cart'] = Cart::where('phone', Session::get('auth_phone'))->where('status', 1)->get();
        $data['meja'] = Meja::pluck('no', 'id');
        $data['transaksi'] = Transaksi::where('phone', Session::get('auth_phone'))->first();
        $data['diskons'] = Diskon::all();
        return view('website.checkout', $data);
    }

    public function pembayaran(Request $request)
    {
        $carts = Cart::where('phone', Session::get('auth_phone'))->where('status', 1)->get();
        $ar = [];

        foreach ($carts as $index => $cart) {
            if (isset($request->listcatatan[$index])) {
                $ar[$cart->id] = $request->listcatatan[$index];
            } else {
                $ar[$cart->id] = '-';
            }
        }

        // Serialisasi hasil array
        $serializedResult = serialize($ar);

        $valueDiskon = preg_replace("/[^0-9]/", "", $request->diskon);

        $transaksi = new Transaksi();
        $transaksi->invoice = "INV-" . date('is') . date('h');
        $transaksi->phone = Session::get('auth_phone');
        $transaksi->nama = Session::get('auth_nama');
        $transaksi->meja_id = $request->meja_id;
        $transaksi->menu = $serializedResult;
        $transaksi->status_pembayaran = 'pending';
        $transaksi->total = $request->total;
        $transaksi->diskon = (int)$valueDiskon;
        $transaksi->catatan = '-';

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->total - (int)$valueDiskon,
            ),
            'customer_details' => array(
                'phone' => Session::get('auth_phone'),
                'nama' => Session::get('auth_nama'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaksi->snap_token = $snapToken;
        if ($transaksi->save()) {
            Cart::where('phone', Session::get('auth_phone'))->update(['status' => 0]);
        }

        return [
            'status' => 'success',
            'message' => 'Successfully created transaction',
            'data' => $transaksi
        ];
    }

    public function success(Request $request, $id)
    {
        $data['meja'] = Meja::pluck('no', 'id');
        $data['transaksi'] = Transaksi::where('id', $id)->first();

        // Jangan ubah status di sini!
        // $data['transaksi']->status_pembayaran = 'success';
        // $data['transaksi']->save();

        return view('website.success', $data);
    }

    public function export()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }

    public function midtransCallback(Request $request)
    {
        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        // Cari transaksi berdasarkan invoice/order_id
        $transaksi = Transaksi::where('invoice', $order_id)->first();

        if ($transaksi) {
            if ($transaction == 'settlement' || $transaction == 'capture') {
                $transaksi->status_pembayaran = 'success';
            } elseif ($transaction == 'pending') {
                $transaksi->status_pembayaran = 'pending';
            } else {
                $transaksi->status_pembayaran = 'failed';
            }
            $transaksi->save();
        }

        return response()->json(['status' => 'ok']);
    }
}
