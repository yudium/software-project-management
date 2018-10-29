<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public $api_key = '29f5e1eb9c3864c214acec950356209d';
    public $token   = '07f77cc8bb14eb26706642c2a02befe56795116c37611ecfa57f17c51345debb';

    public function test()
    {
        $board_id = 'T9tYbuOU';


        $lists = [];

        
        // get all trello's list
        $lists = $this->fetch("https://api.trello.com/1/boards/$board_id/lists?fields=name&key={$this->api_key}&token={$this->token}");

        // get all card of each trello list
        $cards = [];
        foreach ($lists as $index => $list) {
            $cards[$index] = [];
            foreach ($this->fetch("https://api.trello.com/1/lists/{$list->id}/cards?fields=name&key={$this->api_key}&token={$this->token}") as $card) {
                array_push($cards[$index], $card);
            }
        }

        // get all checklist of each trello card
        $checklists = [];
        foreach ($cards as $card) {
            array_push($checklists, $this->fetch("https://api.trello.com/1/cards/{$card->id}/checklists?fields=name&key={$this->api_key}&token={$this->token}"));
        }

        return response()->json($checklists);
    }

    public function fetch($path)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $path, []);

        return json_decode((string) $response->getBody());
    }
}
