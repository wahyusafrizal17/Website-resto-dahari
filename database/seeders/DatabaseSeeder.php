<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Reservasi;
use App\Models\Cart;
use App\Models\Diskon;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // insert user
        $password = Hash::make('password');

        $user = [
            [
                'name'      => 'Administrator',
                'username'  => 'administrator',
                'email'     => 'admin@admin',
                'foto'      => 'foto.png',
                'password'  =>  $password,
                'level'     => 'Admin'
            ],
            // [
            //     'name'      => 'Customer',
            //     'username'  => 'customer',
            //     'email'     => 'customer@customer',
            //     'foto'      => 'foto.png',
            //     'password'  =>  $password,
            //     'level'     => 'Customer'
            // ],
        ];
        User::insert($user);

        // insert menu
        $menu = [
            [
                'nama'        => 'Delicious Pizza',
                'kategori_id' => 1,
                'harga'       => '25000',
                'foto'        => 'menu.png',
                'deskripsi'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.',
            ],
            [
                'nama'        => 'Delicious Burger',
                'kategori_id' => 1,
                'harga'       => '20000',
                'foto'        => 'menu.png',
                'deskripsi'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.',
            ],
            [
                'nama'        => 'Jus Apel',
                'kategori_id' => 2,
                'harga'       => '15000',
                'foto'        => 'menu.png',
                'deskripsi'   => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.',
            ],
        ];
        Menu::insert($menu);

        // insert meja
        for($no = 1; $no < 10; $no++){
            $meja = [
                [
                    'no'  => $no
                ]
            ];
            Meja::insert($meja);
        }

        // insert reservasi
        // $reservasi = [
        //     [
        //         'user_id'        => 2,
        //         'tanggal'        => date('Y-m-d'),
        //         'jam'            => date('H:i:s'),
        //         'jumlah_orang'   => 10,
        //         'meja_id'        => 1,
        //         'catatan'        => '-',
        //     ],
        // ];
        // Reservasi::insert($reservasi);

        // insert cart
        $cart = [
            [
                'phone'          => '081318960576',
                'menu_id'        => 1,
                'jumlah'         => 2,
                'status'         => 1
            ],
            [
                'phone'          => '081318960576',
                'menu_id'        => 2,
                'jumlah'         => 1,
                'status'         => 1
            ],
        ];
        Cart::insert($cart);

        // insert diskon
        $diskon = [
            [
                'nama_diskon'   => 'Diskon 1',
                'value'         => 10000,
            ],
            [
                'nama_diskon'   => 'Diskon 2',
                'value'         => 20000,
            ],
            [
                'nama_diskon'   => 'Diskon 3',
                'value'         => 30000,
            ],
        ];
        Diskon::insert($diskon);

         // insert kategori
         $diskon = [
            [
                'nama_kategori'   => 'Makanan'
            ],
            [
                'nama_kategori'   => 'Minuman'
            ]
        ];
        Kategori::insert($diskon);
        
    }
}
