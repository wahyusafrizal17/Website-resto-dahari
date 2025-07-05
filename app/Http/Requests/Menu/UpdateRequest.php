<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'nama'          => 'required',
            'harga'         => 'required',
            'deskripsi'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'               => 'Nama tidak boleh kosong',
            'harga.required'              => 'Harga tidak boleh kosong',
            'deskripsi.required'          => 'Deskripsi tidak boleh kosong',
        ];
    }
}
