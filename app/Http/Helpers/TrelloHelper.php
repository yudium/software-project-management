<?php
/**
 | ----------------------------------------------------------------------------
 | Helpers all about Trello
 |
 | NOTE: (1) This helper loaded by composer.
 |           New helper file should execute `$ composer dump-autoload`
 |
 |       (2) Helper is registered in composer.json under 'autoload' > 'files' key
 | ----------------------------------------------------------------------------
 */

/**
 * Fetch data from trello API
 *
 * Should I put this function in another helper file? actually this function
 * can named as fetch() without 'trello' word since this function is not
 * specific for Trello but general.
 *
 * @return array
 */
function fetchTrello($path) {
    $client = new \GuzzleHttp\Client();

    /**
     * user should catch exception from this method
     *
     *      \GuzzleHttp\Exception\ConnectException
     *      \GuzzleHttp\Exception\ClientException
     *      \GuzzleHttp\Exception\TooManyRedirectsException
     *      \GuzzleHttp\Exception\RequestException
     *      \GuzzleHttp\Exception\ServerException
     *
     * check: http://docs.guzzlephp.org/en/stable/quickstart.html#exceptions
     */
    $response = $client->request('GET', $path, []);


    return json_decode((string) $response->getBody(), true);
}

/**
 * Fetch all board's list
 *
 * @return array
 */
function getTrelloList($board_id, $query, $auth) {
    if ($query === null) $query = [];

    $query_params = array_to_query_params(array_merge($query, $auth));

    return fetchTrello("https://api.trello.com/1/boards/$board_id/lists?$query_params");
}

/**
 * Fetch all list's card
 *
 * @return array
 */
function getTrelloCard($list_id, $query, $auth) {
    if ($query === null) $query = [];

    $query_params = array_to_query_params(array_merge($query, $auth));

    return fetchTrello("https://api.trello.com/1/lists/$list_id/cards?$query_params");
}

/**
 * Fetch all card's checklists
 *
 * @return array
 */
function getTrelloChecklist($card_id, $query, $auth) {
    if ($query === null) $query = [];

    $query_params = array_to_query_params(array_merge($query, $auth));

    return fetchTrello("https://api.trello.com/1/cards/$card_id/checklists?$query_params");
}

/**
 * Fetch all board's action
 *
 * @return array
 */
function getTrelloAction($board_id, $query, $auth) {
    if ($query === null) $query = [];

    $query_params = array_to_query_params(array_merge($query, $auth));

    return fetchTrello("https://api.trello.com/1/boards/$board_id/actions?$query_params");
}

/**
 * Fetch all board's list
 *
 * @return array
 */
function getTrelloChecklistByBoardId($board_id, $query, $auth) {
    if ($query === null) $query = [];

    $query_params = array_to_query_params(array_merge($query, $auth));

    return fetchTrello("https://api.trello.com/1/boards/$board_id/checklists?$query_params");
}

/**
 * Get progress for specific project in tens percent
 *
 * @param $project      Project eloquent model
 *
 * @return number       number between 0 - 100
 */
function getTrelloProgressByBoardId(
    $board_id,
    $auth,
    & $number_of_task = null,               // optional
    & $number_of_task_complete = null       // optional
) {
        $checklists = getTrelloChecklistByBoardId($board_id, ['fields' => 'checkItems'], $auth);

        /**
        | count (1) number of task and (2) complete task on trello board
        | --------------------------------------------------------------- */
        $number_of_task = 0;
        $number_of_task_complete = 0;
        foreach (array_flatten($checklists) as $value) {
            // To counter number of all task dan complete task. Actually we
            // just need 'checkItems' child array. More precisely, we only need
            // to counter the 'state' element in 'checkItems' child array.
            // 'state' element only contains 'complete' or 'incomplete'.
            //
            // So, I flatten the array, means all element of child array
            // (multi-dimensional array) become top element. So we get
            // 1-dimensional array. And use if statement to check if current
            // element is 'state' element by checking the element's value.
            if ($value == 'incomplete' || $value == 'complete') {
                $number_of_task++;

                if ($value == 'complete') $number_of_task_complete++;
            }
        }


        /**
         | get progress percent in tens
         | --------------------------------------------------------------- */
         if ($number_of_task == 0) {
             return 0;
         }
         return ($number_of_task_complete / $number_of_task) * 100;
}

/**
 * Get last progress activity for specific board_id
 *
 * @return array    returned json from trello api
 */
function getTrelloLastProgress($board_id, $auth)
{
    /**
        | get last complete task on trello board
        | --------------------------------------- */
    $last_complete_task = null;
    // get all recent action or activity
    $actions = getTrelloAction($board_id, ['fields' => 'data,type,date'], $auth);
    // iterate for searching last complete task
    foreach ($actions as $action) {
        // not all action is trello checkItem activity, for example there is action 'addChecklistToCard'
        if ($action['type'] == 'updateCheckItemStateOnCard') {
            // array_get is laravel helper
            if (array_get($action, 'data.checkItem.state') == 'complete') {
                $last_complete_task = $action;
                break;
            }
        }
    }

    return $last_complete_task;
}
