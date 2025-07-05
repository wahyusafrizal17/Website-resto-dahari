<div class="card-body">

  <div class="form-group">
      <label>No Meja</label>
      {{ Form::text('no',null,['class'=>'form-control'])}}
      @if ($errors->has('no')) <span class="help-block" style="color:red">{{ $errors->first('no') }}</span> @endif
  </div>

</div>

<div class="card-footer">
  <div class="form-group">
      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
          
      <a href="{{ route('admin.meja.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i> Kembali</a>
  </div>
</div>