<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Meja;
use App\Http\Requests\Reservasi\StoreRequest;
use App\Http\Requests\Reservasi\UpdateRequest;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $data['model'] = Reservasi::all();

        return view('admin.reservasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::where('level', 'Customer')->pluck('name', 'id');
        $data['meja'] = Meja::pluck('no', 'id');
        return view('admin.reservasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $input = $request->all();

        // Cek apakah reservasi bentrok (sudah ada meja yang dipakai di tanggal & jam itu)
        $conflict = Reservasi::where('meja_id', $input['meja_id'])
            ->where('tanggal', $input['tanggal'])
            ->where('jam', $input['jam'])
            ->exists();

        if ($conflict) {
            alert()->error('Reservasi Gagal', 'Meja sudah dipesan pada tanggal dan jam tersebut.');
            return redirect()->back()->withInput();
        }

        // Jika tidak bentrok, simpan
        $reservasi = Reservasi::create($input);

        $qrcodeData = 'Nama: ' . $input['nama'] . "\nNo HP: " . $input['no_hp'];

        session([
            'qrcodeData' => $qrcodeData,
            'nama' => $input['nama'],
            'no_hp' => $input['no_hp'],
        ]);

        alert()->success('Reservasi Berhasil', 'Reservasi berhasil dilakukan oleh ' . $input['nama']);

        return redirect('/reservasi');
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
        $data['model'] = Reservasi::find($id);
        $data['users'] = User::where('level', 'Customer')->pluck('name', 'id');
        $data['meja'] = Meja::pluck('no', 'id');
        return view('admin.reservasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $model = Reservasi::find($id);
        $input = $request->all();
        $model->update($input);
        alert()->success('Data berhasil diubah', 'Berhasil');
        return redirect('admin/reservasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Reservasi::find($id);
        $model->delete();

        alert()->success('Data berhasil dihapus', 'Berhasil');
        return redirect('admin/reservasi');
    }

    public function delete(Request $request)
    {
        $category = Reservasi::find($request->id);
        $category->delete();

        return 'success';
    }

    public function reservasi()
    {
        $meja = Meja::pluck('no', 'id');
        $qrcodeData = session('qrcodeData');
        $nama = session('nama');
        $no_hp = session('no_hp');
        // Hapus session setelah diambil
        session()->forget(['qrcodeData', 'nama', 'no_hp']);
        return view('website.reservasi', [
            'meja' => $meja,
            'qrcodeData' => $qrcodeData,
            'nama' => $nama,
            'no_hp' => $no_hp,
        ]);
    }
}
