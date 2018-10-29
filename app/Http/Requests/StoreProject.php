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

        /**
         * 1. PIC,
         * 2. backup_source_code_project_link,
         * 3. project_link
         *
         * should use `nullable` validation rule, after `sanitize` method called
         * because it can be empty array `[]` if those field not filled by user
         */
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
            'PIC.*' => 'nullable|string',
            'backup_source_code_project_link.*' => 'nullable|url',
            'project_link.*' => 'nullable|url',
        ];
    }

    protected function sanitize()
    {
        /**
         * NOTE: By default, Laravel change any empty field (including only whitespace content)
         *       to be NULL value
         */
        $input = $this->all();

        /**
         * remove any empty input field from:
         *
         *  1. PIC,
         *  2. backup_source_code_project_link,
         *  3. project_link
         *
         * NOTE: always make sure in UI that each of above array input
         *       have at least 1 input field so error like
         *
         *       "Undefined index: PIC"
         *
         *       will not occurs.
         */
        if ($input['PIC']) {
            array_filter_null_element($input['PIC']);
        }
        if ($input['backup_source_code_project_link']) {
            array_filter_null_element($input['backup_source_code_project_link']);
        }
        if ($input['project_link']) {
            array_filter_null_element($input['project_link']);
        }

        $this->replace($input);
    }
}
