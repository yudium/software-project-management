<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsider extends FormRequest
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
        $this->sanitize();

        return [
            'nama.*'=>'nullable',
            'jabatan.*'=>'nullable',
            'alamat.*'=>'nullable',
            'telepon.*'=>'nullable',
            'email.*'=>'nullable',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        if ($input['telepon']) {
            array_filter_null_element($input['telepon']);
        }
        if ($input['email']) {
            array_filter_null_element($input['email']);
        }
        $this->replace($input);
        
    }
}
