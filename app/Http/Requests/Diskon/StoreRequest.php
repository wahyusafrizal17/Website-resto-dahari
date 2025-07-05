<?php

namespace App\Http\Requests\Diskon;

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
            'nama_diskon'          => 'required',
            'value'                => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_diskon.required'            => 'Nama diskon tidak boleh kosong',
            'value.required'                  => 'Value tidak boleh kosong'
        ];
    }
}
