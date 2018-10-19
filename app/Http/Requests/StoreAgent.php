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
            'nama'=>'required',
            'alamat'=>'required',
            'kota'=>'required',
            'telepon'=>'required|numeric',
            'email'=>'required|email',
            'norek'=>'required|numeric',
            'web'=>'required|url',
            'foto'=>'',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        dd($input);
        $old_telepon = $input['agent-telepon'];
        $input['agent-telepon'] = [];
        foreach($old_telepon as $key => $telepon){
            if(trim($telepon)) array_push($input['agent-telepon'],$telepon);
        }

        $old_email = $input['agent-email'];
        $input['agent-email'] = [];
        foreach($old_email as $key =>$email){
            if(trim($email)) array_push($input['agent-email'],$email);

        }
        
        $old_norek = $input['agent-norek'];
        $input['agent-norek'] = [];
        foreach($old_norek as $key =>$norek){
            if(trim($norek)) array_push($input['agent-norek'],$norek);
    
         }

        $old_web = $input['agent-web'];
        $input['agent-web'] = [];
        foreach($old_web as $key =>$web){
            if(trim($web)) array_push($input['agent-web'],$web);

        }
        $this->replace($input);
    }
}
