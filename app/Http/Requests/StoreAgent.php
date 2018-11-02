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
            // 'telepon'=>'required',
            // 'email'=>'required',
            // 'norek'=>'required',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
    //   dd($input);
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
        // dd($input);
        $this->replace($input);
    }
}
