<?php

namespace App\Http\Requests\Meja;

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
            'no'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no.required'               => 'No meja tidak boleh kosong'
        ];
    }
}
