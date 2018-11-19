<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Project;

class ProgressController extends Controller
{
    private $auth = [
        'key' => null,
        'token' => null,
    ];

    public function __construct()
    {
        $this->auth = [
            'key' => \Setting::value('trello_api_key'),
            'token' => \Setting::value('trello_token'),
        ];
    }

    public function get($project_id)
    {
        $auth = $this->auth;

        $project = Project::find($project_id);

        $board_id = $project->trello_board_id;

        try
        {
            $number_of_task = 0;
            $number_of_task_complete = 0;
            $progress_percent = getTrelloProgressByBoardId(
                $board_id,
                $auth,
                $number_of_task,            // pass by reference
                $number_of_task_complete    // pass by reference
            );

            $last_complete_task = getTrelloLastProgress($board_id, $auth);
        }
        catch (\GuzzleHttp\Exception\ConnectException $e)
        {
            abort(502, 'Can\'t connect to Trello. Check your internet');
        }
        catch (\GuzzleHttp\Exception\ClientException $e)
        {
            abort(400, 'Error 4XX HTTP Code');
        }
        catch (\GuzzleHttp\Exception\TooManyRedirectsException $e)
        {
            abort(502, 'Too Many Redirection from Trello');
        }
        catch (\GuzzleHttp\Exception\RequestException $e)
        {
            abort(502, 'Networking error');
        }
        catch (\GuzzleHttp\Exception\ServerException $e)
        {
            abort(500, 'Error 5XX HTTP Code');
        }

        return view('progress', compact(
            'project',
            'board_id',
            'auth',
            'number_of_task',
            'number_of_task_complete',
            'progress_percent',
            'last_complete_task'
        ));
    }
}
