<table width="100%">
    <thead>
       <tr>
          <th>No</th>
          <th>Invoice</th>
          <th>Nama Customer</th>
          <th>No Meja</th>
          <th>Menu</th>
          <th>Status Pembayaran</th>
          <th>Catatan</th>
          <th>Diskon</th>
          <th>Total</th>
          <th>Subtotal</th>
          <th>Tanggal Transaksi</th>
       </tr>
    </thead>
    <tbody>
        @foreach($model as $row)
       <tr>
          <td>{{ $loop->iteration }}</td>
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
          <td>{{ $row->status_pembayaran }}</td>
          <td>{{ $row->catatan }}</td>
          <td>@currency($row->diskon)</td>
          <td>@currency($row->total)</td>
          <td>@currency($row->total-$row->diskon)</td>
          <td>{{ substr($row->created_at,0,10) }}</td>
       </tr>
       @endforeach
    </tbody>
 </table>