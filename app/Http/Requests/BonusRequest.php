<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonusRequest extends FormRequest
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
            'pegawai_id'=>'required',
            'persen_bonus'=>'required',
            'total_bonus'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'pegawai_id.required'=>'Nama Pegawai wajib diisi',
            'persen_bonus.required'=>'Persen bonus wajib diisi',
            'total_bonus.required'=>'Total Bonus wajib diisi'
        ];
    }
}
