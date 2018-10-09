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
            'nama'=>'required',
            'jabatan'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'email'=>'required',
        ];
    }

    public function sanitize()
    {
        $input = $this->all();
        // print_r($input);
        $old_telepon = $input['telepon'];
        $count_telepon = count($input['telepon']);
        $input['telepon'] = [];
        for($i=1 ; $i <=$count_telepon ; $i++)
        {
            $input['telepon'][$i] = [];
            foreach($old_telepon[$i] as $key=>$telepon)
            {
                if(trim($telepon)) array_push($input['telepon'][$i],$telepon);
            }
        }
     
        $old_email = $input['email'];
        $count_email = count($input['email']);
        $input['email'] = [];
        for($i=1 ; $i <=$count_email ; $i++)
        {
            $input['email'][$i] = [];
            foreach($old_email[$i] as $key=>$email)
            {
                if(trim($email)) array_push($input['email'][$i],$email);
            }
        }

       
        $this->replace($input);
        
    }
}
