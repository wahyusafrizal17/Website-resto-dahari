@extends('layouts.app-website')
@section('content')

<style>
  .bg-box{
    display: none
  }
  .header_section{
    background: linear-gradient(to bottom, #f1f2f3 0px, #222831 0px)
  }
  section{
    min-height: 550px;
  }
</style>
 
  <!-- food section -->

  <section class="food_section layout_padding-bottom mt-4">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Pesanan
        </h2>
      </div>

      <div class="table-responsive mt-4">
        <table id="basic-datatables" class="display table table-striped table-hover">
           <thead>
              <tr>
                 <th style="width: 5%">No</th>
                 <th>No Hp</th>
                 <th>Nama</th>
                 <th>No Meja</th>
                 <th>Menu</th>
                 <th>Status Pembayaran</th>
                 <th>Tanggal</th>
                 <th>#</th>
              </tr>
           </thead>
           <tbody>
            @if(count($model) > 0)
            @foreach($model as $row)
              <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ $row->phone }}</td>
                 <td>{{ $row->nama }}</td>
                 <td>{{ $row->meja->no }}</td>
                 <td>
                  <?php
                    $mn = unserialize($row->menu);
                  ?>
                  <ul>
                    @foreach($mn as $m => $list)
                    <li>{{ getCart($m)->menu->nama }} x {{ getCart($m)->jumlah }}</li>
                  @endforeach
                 </td>
                 <td>
                @if($row->status_pembayaran == 'pending')
                  <span class="badge badge-danger">Pembayaran Gagal</span>
                @elseif($row->status_pembayaran == 'success')
                  <span class="badge badge-info">Berhasil</span>
                @else
                  <span class="badge badge-secondary">{{ ucfirst($row->status_pembayaran) }}</span>
                @endif
                 </td>
                 <td>{{ substr($row->created_at,0,10) }}</td>
                 <td>
                  <a href="{{ route('website.detail', $row->id) }}" class="btn btn-info btn-sm">Detail <i class="fa fa-eye"></i></a>
                 </td>
              </tr>
              @endforeach
            @else
            <tr>
              <td colspan="8" align="center"><small>(Data pesanan kosong)</small></td>
            </tr>
            @endif
               
           </tbody>
        </table>
     </div>


    </div>
  </section>

  <div class="mt-5"></div>
  <div class="mt-5"></div>
  <!-- end food section -->

  @endsection
