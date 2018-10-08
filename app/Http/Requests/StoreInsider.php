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
        print_r($input);
        // $old_nama = $input['nama'];
        // $input['nama'] = [];
        // foreach($old_nama as $key=>$nama){
        //     if(trim($nama)) array_push($input['nama'],$nama);
        // }

        // $old_jabatan = $input['jabatan'];
        // $input['jabatan'] = [];
        // foreach($old_jabatan as $key=>$jabatan){
        //     if(trim($jabatan)) array_push($input['jabatan'],$jabatan);
        // }

        // $old_alamat = $input['alamat'];
        // $input['alamat'] = [];
        // foreach($old_alamat as $key=>$alamat){
        //     if(trim($alamat)) array_push($input['alamat'],$alamat);
        // }

        // $old_telepon = $input['telepon'];
        // $input['telepon'][$i] = [][];
        
        // foreach($old_telepon as $key=>$telepon){
        //     if(trim($telepon)) array_push($input['telepon'],$telepon);
        //     foreach($telepon as $key=>$tel){
        //         print_r($tel[3]);
        //     }
         
        // }

        // $old_email = $input['email'];
        // $input['email'] = [];
        // foreach($old_email as $key=>$email){
        //     if(trim($email)) array_push($input['email'],$email);
        // }

        $this->replace($input);
        
    }
}
