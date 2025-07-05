<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use App\Http\Requests\Menu\StoreRequest;
use App\Http\Requests\Menu\UpdateRequest;

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['model'] = Menu::all();

        return view('admin.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = Kategori::pluck('nama_kategori', 'id');
        return view('admin.menu.create', $data);
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
        if($request->hasFile('foto')){
            $File = 'foto_' . date('Ymdhis').'.png';
            $Path = base_path().'/'.'public'.'/menu';
            $request->file('foto')->move($Path, $File);

            $input['foto'] = $File;
        }
        Menu::create($input);

        alert()->success('Data berhasil disimpan', 'Berhasil');
        return redirect('admin/menu');
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
        $data['model'] = Menu::find($id);
        $data['kategori'] = Kategori::pluck('nama_kategori', 'id');
        return view('admin.menu.edit', $data);
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
        $model = Menu::find($id);
        $input = $request->all();
        if($request->hasFile('foto')){
            $File = 'foto_' . date('Ymdhis').'.png';
            $Path = base_path().'/'.'public'.'/menu';
            $request->file('foto')->move($Path, $File);

            $input['foto'] = $File;
        }
        $model->update($input);

        alert()->success('Data berhasil diubah', 'Berhasil');
        return redirect('admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Menu::find($id);
        $model->delete();

        alert()->success('Data berhasil dihapus', 'Berhasil');
        return redirect('admin/menu');
    }

    public function delete(Request $request)
    {
        $category = Menu::find($request->id);
        $category->delete();

        return 'success';
    }

    public function website()
    {
        $data['menus'] = Menu::all();
        return view('website.menu', $data);
    }
}
