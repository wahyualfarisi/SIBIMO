<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddJurusan extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_jurusan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_jurusan' => 'A title is required'
        ];
    }
}
