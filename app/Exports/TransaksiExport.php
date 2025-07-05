<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;

class TransaksiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Transaksi::all();
    // }


    public function view(): View
    {
        return view('admin.transaksi.export', [
            'model' => Transaksi::all()
        ]);
    }

    // public function headings(): array
    // {
    //     return [
    //         "Id", 
    //         "Invoice", 
    //         "Nama Customer",
    //         "No Meja",
    //         "Menu",
    //         "Status Pembayaran",
    //         "Diskon",
    //         "Total",
    //         "Catatan",
    //         "Snap Token",
    //         "Created At",
    //         "Updated At",
    //     ];
    // }
}
