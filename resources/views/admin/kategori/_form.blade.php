<div class="card-body">

  <div class="form-group">
      <label>Nama kategori</label>
      {{ Form::text('nama_kategori',null,['class'=>'form-control'])}}
      @if ($errors->has('nama_kategori')) <span class="help-block" style="color:red">{{ $errors->first('nama_kategori') }}</span> @endif
  </div>

</div>

<div class="card-footer">
  <div class="form-group">
      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
          
      <a href="{{ route('admin.kategori.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i> Kembali</a>
  </div>
</div>