<div class="card-body">

  <div class="form-group">
      <label>Nama</label>
      {{ Form::text('nama',null,['class'=>'form-control'])}}
      @if ($errors->has('nama')) <span class="help-block" style="color:red">{{ $errors->first('nama') }}</span> @endif
  </div>

  <div class="form-group mt-2">
      <label>Kategori</label>
      {{ Form::select('kategori_id',$kategori, null,['class'=>'form-control select2'])}}
      @if ($errors->has('kategori_id')) <span class="help-block" style="color:red">{{ $errors->first('kategori_id') }}</span> @endif
  </div>

  <div class="form-group mt-2">
    <label>Harga</label>
    {{ Form::text('harga',null,['class'=>'form-control'])}}
    @if ($errors->has('harga')) <span class="help-block" style="color:red">{{ $errors->first('harga') }}</span> @endif
</div>

  <div class="form-group mt-2">
    <label>Deskripsi</label>
    {{ Form::textarea('deskripsi',null,['class'=>'form-control', 'rows' => 3])}}
    @if ($errors->has('deskripsi')) <span class="help-block" style="color:red">{{ $errors->first('deskripsi') }}</span> @endif
</div>

<div class="form-group mt-2">
  <label>Foto</label>
  {{ Form::file('foto',['class'=>'form-control'])}}
  @if ($errors->has('foto')) <span class="help-block" style="color:red">{{ $errors->first('foto') }}</span> @endif
</div>

</div>

<div class="card-footer">
  <div class="form-group">
      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
          
      <a href="{{ route('admin.menu.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i> Kembali</a>
  </div>
</div>