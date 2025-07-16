@extends('layouts.app')
@section('title','Manage Slider Image')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
         <div class="content-header row" >
            <div class="content-header-left col-md-9 col-12 mb-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Transaksi</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a>
                                </li>
                                <li class="breadcrumb-item active">index
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Data Transaksi</h4>
                              <a href="{{ route('admin.transaksi.export') }}" class="btn btn-primary btn-sm">
                                 <i class="fa fa-plus"></i> Export
                              </a>
                          </div>
                          
                           <div class="card-body">
                              <form action="">
                                 <div class="input-group mb-2">
                                    <select class="form-control" name="filter" aria-label="Select Month" aria-describedby="basic-addon-search1">
                                        <option value="">Pilih Bulan...</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="submit" id="basic-addon-search1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </div>
                              </form>

                              <div class="table-responsive">
                                 <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                       <tr>
                                          <th style="width: 5%">No</th>
                                          <th>Aksi</th>
                                          <th>Invoice</th>
                                          <th>Nama Customer</th>
                                          <th>No Meja</th>
                                          <th>Menu</th>
                                          <th>Catatan</th>
                                          <th>Status Pembayaran</th>
                                          <th>Tanggal</th>
                                          <th>Diskon</th>
                                          <th>Total</th>
                                          <th>Subtotal</th>
                                          <th>Konfirmasi</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($model as $row)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>
                                            @if(!$row->konfirmasi)
                                              <form action="{{ route('admin.transaksi.konfirmasi', $row->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" style="width: 100px;">Konfirmasi</button>
                                              </form>
                                            @endif
                                           <form action="{{ route('admin.transaksi.destroy', $row->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn btn-danger btn-sm" style="width: 100px;">Hapus</button>
                                           </form>
                                          </td>
                                          <td>{{ $row->invoice}}</td>
                                          <td>{{ $row->nama }}</td>
                                          <td>{{ $row->meja->no }}</td>
                                          <td>
                                             <?php
                                                $mn = unserialize($row->menu);
                                             ?>
                                             <ul>
                                             @foreach($mn as $m => $a)
                                             <li>{{ getCart($m)->menu->nama }} x {{ getCart($m)->jumlah }}</li>
                                             @endforeach
                                          </ul>
                                          </td>
                                          <td>
                                            <?php
                                                $mn = unserialize($row->menu);
                                             ?>
                                             <ul>
                                             @foreach($mn as $m => $a)
                                             <li>{{ $a }}</li>
                                             @endforeach
                                          </td>
                                          <td>{{ $row->status_pembayaran }}</td>
                                          <td>{{ substr($row->created_at,0,10) }}</td>
                                          <td>@currency($row->diskon)</td>
                                          <td>@currency($row->total)</td>
                                          <td>@currency($row->total-$row->diskon)</td>
                                          <td>
                                              @if(!$row->konfirmasi)
                                                <span class="badge bg-warning text-dark">Belum Diproses</span>
                                              @else
                                                <span class="badge bg-success">Sudah Diproses</span>
                                              @endif
                                          </td>
                                          
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('scripts')
<script>
$(document).ready(function() {

  

});

</script>
@endpush