<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProject extends FormRequest
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
         *
         * sanitize method will remove any empty input from array
         */
        return [
            'name' => 'required|max:255|min:3',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'starttime' => 'nullable|date_format:"j F, Y"',
            'endtime' => 'nullable|date_format:"j F, Y"',
            'DP_time' => 'nullable|date_format:"j F, Y"',
            'additional_note' => 'nullable',
            'PIC.*' => 'nullable|distinct',
            'backup_source_code_project_link.*' => 'nullable|url|distinct',
            'project_link.*' => 'nullable|url|distinct',
            'trello_board_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    // get current project
                    $project_id = \Route::current()->parameter('id');
                    $project = \App\Project::find($project_id);

                    // we can skip this validation since the value is not changed. So we can save 1 request to trello API
                    if ($project->trello_board_id == $value) return;

                    $trello_key = \Setting::value('trello_api_key');
                    $trello_token = \Setting::value('trello_token');

                    $client = new \GuzzleHttp\Client();

                    try
                    {
                        $response = $client->request('GET', "https://api.trello.com/1/boards/$value?key=$trello_key&token=$trello_token", []);
                    }
                    catch (\GuzzleHttp\Exception\ConnectException $e)
                    {
                        $fail('Tidak bisa memvalidasi melalui Trello API server. Koneksi anda mungkin sedang bermasalah. Solusi sementara: Anda boleh mengosongkan field ini');
                    }
                    catch (\GuzzleHttp\Exception\ClientException $e)
                    {
                        $fail('Error HTTP 400 dari Trello API server. Mungkin trello board id tidak ada. Solusi sementara: Anda boleh mengosongkan field ini');
                    }
                    catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
                    {
                        $fail('Error Too Many Redirection dari Trello API server. Solusi sementara: Anda boleh mengosongkan field ini');
                    }
                    catch (\GuzzleHttp\Exception\RequestException $e)
                    {
                        $fail('Error koneksi. Gagal memvalidasi trello board id. Solusi sementara: Anda boleh mengosongkan field ini');
                    }
                    catch (\GuzzleHttp\Exception\ServerException $e)
                    {
                        $fail('Error HTTP 500 dari Trello API server. Solusi sementara: Anda boleh mengosongkan field ini');
                    }
                }
            ],
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
         | remove any empty input field from:
         |
         |  1. PIC,
         |  2. backup_source_code_project_link,
         |  3. project_link
         |
         | NOTE: always make sure in UI that each of above array input
         |       have at least 1 input field so error like
         |
         |       "Undefined index: PIC"
         |
         |       will not occurs.
         | ---------------------------------------------------------------- */

        // I need this if condition for edit-form_restricted.blade.php that doesn't have PIC input field
        if (array_key_exists('PIC', $input)) {
            if ($input['PIC']) {
                array_filter_null_element($input['PIC']);
            }
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
