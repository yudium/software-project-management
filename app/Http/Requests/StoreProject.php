<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'project_type_id' => 'required|exists:project_types,id',
            'name' => 'required|max:255|min:3',
            'price' => 'nullable|numeric',
            'starttime' => 'nullable|date_format:"j F, Y"',
            'endtime' => 'nullable|date_format:"j F, Y"',
            'DP_time' => 'nullable|date_format:"j F, Y"',
            'additional_note' => '',
            'trello_board_id' => 'max:255|min:3',
            'PIC.*' => 'required|string|distinct',
            'backup_source_code_project_link.*' => 'nullable|distinct|url',
            'project_link.*' => 'nullable|distinct|url',
        ];
    }

    protected function sanitize()
    {
        $input = $this->all();

        // remove any empty input field
        $old_PIC = $input['PIC'];
        $input['PIC'] = [];
        foreach ($old_PIC as $key => $pic) {
            if (trim($pic)) array_push($input['PIC'], $pic);
        }

        // remove any empty input field
        $old_backuplink = $input['backup_source_code_project_link'];
        $input['backup_source_code_project_link'] = [];
        foreach ($old_backuplink as $key => $link) {
            if (trim($link)) array_push($input['backup_source_code_project_link'], $link);
        }

        // remove any empty input field
        $old_projectlink = $input['project_link'];
        $input['project_link'] = [];
        foreach ($old_projectlink as $key => $link) {
            if (trim($link)) array_push($input['project_link'], $link);
        }

        $this->replace($input);
    }
}
