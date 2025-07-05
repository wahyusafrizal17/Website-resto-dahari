<?php

namespace App\Http\Requests\Reservasi;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama'             => 'required',
            'no_hp'            => 'required',
            'tanggal'          => 'required',
            'jam'              => 'required',
            'jumlah_orang'     => 'required',
            'meja_id'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'                  => 'Nama tidak boleh kosong',
            'no_hp.required'                 => 'Np hp tidak boleh kosong',
            'tanggal.required'               => 'Tanggal tidak boleh kosong',
            'jam.required'                   => 'Jam tidak boleh kosong',
            'jumlah_orang.required'          => 'Jumlah orang tidak boleh kosong',
            'meja_id.required'               => 'No meja tidak boleh kosong',
        ];
    }
}
