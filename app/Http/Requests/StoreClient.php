<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
            'tipeProspect'=>'', // TODO: for what??
            'nama'=>'required|min:2',
            'statusHub'=>'nullable',
            'alamat'=>'nullable',
            'kota.*'=>'nullable|string',
             'telepon.*'=>'nullable|numeric',
             'email.*'=>'nullable|email',
            'norek.*'=>'nullable|numeric',
            'web.*'=>'nullable|url',
        

        ];
    }

    // public function messages()
    // {
    //     return [
    //         'kota[].required' => 'The kota field  is required',
    //         'telepon[].required'  => 'The telepon field  is required',
    //         'email[].required' => 'The email field  is required',
    //         'norek[].required'  => 'The norek field  is required',
    //         'web[].required' => 'The web field  is required',
       
    //     ];
    // }

    public function sanitize()
    {
        $input = $this->all();

        if ($input['kota']) {
            array_filter_null_element($input['kota']);
        }
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
        $this->replace($input);   

    }


}
