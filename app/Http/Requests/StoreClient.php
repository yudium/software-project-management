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
            'tipeProspect'=>'',
            'nama'=>'required|min:2',
            'statusHub'=>'',
            'alamat'=>'required',
            // 'kota[]'=>'required',
            // 'telepon[]'=>'required|numeric',
            // 'email[]'=>'required|email',
            // 'norek[]'=>'required',
            // 'web[]'=>'required|url',
        

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

        $old_kota =  $input['kota'];
        $input['kota'] = [];
        foreach($old_kota as $key => $kota){
            if(trim($kota)) array_push($input['kota'],$kota);
        }

        $old_telepon = $input['telepon'];
        $input['telepon'] = [];
        foreach($old_telepon as $key => $telepon){
            if(trim($telepon)) array_push($input['telepon'],$telepon);
        }

        $old_email = $input['email'];
        $input['email'] = [];
        foreach($old_email as $key =>$email){
            if(trim($email)) array_push($input['email'],$email);

        }
        
        $old_norek = $input['norek'];
        $input['norek'] = [];
        foreach($old_norek as $key =>$norek){
            if(trim($norek)) array_push($input['norek'],$norek);
    
         }

        $old_web = $input['web'];
        $input['web'] = [];
        foreach($old_web as $key =>$web){
            if(trim($web)) array_push($input['web'],$web);

        }
        $this->replace($input);   

    }


}
