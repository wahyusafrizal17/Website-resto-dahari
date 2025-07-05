<div class="card-body">

  <div class="form-group">
      <label>Nama Customer</label>
      {{ Form::select('user_id', $users, null, ['class' => 'form-control select2']) }}
      @if ($errors->has('nama')) <span class="help-block" style="color:red">{{ $errors->first('nama') }}</span> @endif
  </div>

  <div class="form-group mt-2">
    <label>Tanggal</label>
    {{ Form::date('tanggal',null,['class'=>'form-control'])}}
    @if ($errors->has('tanggal')) <span class="help-block" style="color:red">{{ $errors->first('tanggal') }}</span> @endif
</div>

  <div class="form-group mt-2">
    <label>Jam</label>
    {{ Form::time('jam',null,['class'=>'form-control'])}}
    @if ($errors->has('jam')) <span class="help-block" style="color:red">{{ $errors->first('jam') }}</span> @endif
</div>

  <div class="form-group mt-2">
    <label>No Meja</label>
    {{ Form::select('meja_id', $meja, null, ['class' => 'form-control select2']) }}
    @if ($errors->has('jam')) <span class="help-block" style="color:red">{{ $errors->first('jam') }}</span> @endif
</div>

  <div class="form-group mt-2">
    <label>Jumlah Orang</label>
    {{ Form::number('jumlah_orang',null,['class'=>'form-control'])}}
    @if ($errors->has('jumlah_orang')) <span class="help-block" style="color:red">{{ $errors->first('jumlah_orang') }}</span> @endif
</div>

  <div class="form-group mt-2">
    <label>Catatan</label>
    {{ Form::textarea('catatan',null,['class'=>'form-control', 'rows' => 3])}}
    @if ($errors->has('catatan')) <span class="help-block" style="color:red">{{ $errors->first('catatan') }}</span> @endif
</div>

</div>

<div class="card-footer">
  <div class="form-group">
      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
          
      <a href="{{ route('admin.reservasi.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i> Kembali</a>
  </div>
</div>