<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgent extends FormRequest
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
            'nama'=>'required|min:2',
            'alamat'=>'required',
            'kota'=>'required',
            'photoAgent'=>'',
            'telepon.*'=>'nullable|numeric|required',
            'email.*'=>'nullable|email|required',
            'norek.*'=>'nullable|numeric|required',
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
        if ($input['norek']) {
            array_filter_null_element($input['norek']);
        }
        if ($input['web']) {
            array_filter_null_element($input['web']);
        }
        // dd($input);
        $this->replace($input);
    }
}
