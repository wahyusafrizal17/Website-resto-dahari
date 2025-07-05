<div class="card-body">

  <div class="form-group">
      <label>Nama Diskon</label>
      {{ Form::text('nama_diskon',null,['class'=>'form-control'])}}
      @if ($errors->has('nama_diskon')) <span class="help-block" style="color:red">{{ $errors->first('nama_diskon') }}</span> @endif
  </div>
  <div class="form-group mt-2">
      <label>Value</label>
      {{ Form::number('value',null,['class'=>'form-control'])}}
      @if ($errors->has('value')) <span class="help-block" style="color:red">{{ $errors->first('value') }}</span> @endif
  </div>

</div>

<div class="card-footer">
  <div class="form-group">
      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
          
      <a href="{{ route('admin.diskon.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i> Kembali</a>
  </div>
</div>