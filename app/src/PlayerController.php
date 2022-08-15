<?php

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\ORM\DB;
use SilverStripe\Core\Convert;
use SilverStripe\View\ArrayData;

class PlayerController extends Controller
{
    private static $allowed_actions = [
        'index',
        'store',
        'show',
        'update',
        'list',
        'delete'
    ];

    // private static $url_handlers = [
    //     '$ID' => 'show',
    //     'update/$ID!' => 'update',
    //     'delete/$ID!' => 'delete',
    // ];


    public function index(HTTPRequest $request)
    {
        return  [
            'Title' => 'Players',
            'Content' => 'Test'
        ];
    }
    public function store(HTTPRequest $request)
    {
        $data = $request->requestVars();

        $player = new Player();
        $player->FirstName = $data['Nama'];
        $player->LastName = $data['NamaBelakang'];
        $player->PlayerNumber = $data['NomorPunggung'];
        $player->write();
        return json_encode($player->toMap());
    }
    public function show()
    {
        $params = $this->getURLParams();
        $player = Player::get()->byID($params);

        return json_encode($player->toMap());
    }

    public function update(HTTPRequest $request)
    {

        $all = $request->requestVars();
        // $FirstName = "Tes";
        // $LastName = "Testingggggg'";
        // $PlayerNumber = "20";

        // Convert::raw2sql('SELECT PlayerNumber FROM player WHERE id = 1;');
        // $id = 'SELECT id FROM player WHERE id = 1';

        // $player->FirstName = Convert::raw2sql($FirstName);
        // $player->LastName = Convert::raw2sql($LastName);
        // $player->PlayerNumber = Convert::raw2sql($PlayerNumber);

        // Player::get()->byID(1)
        // $player = DB::query('SELECT id, FirstName, LastName, PlayerNumber FROM player WHERE id = 1');
        $all['Nama'] = Convert::raw2sql($all['Nama']);
        $all['NamaBelakang'] = Convert::raw2sql($all['NamaBelakang']);

        $player = Player::get()->byID(Convert::raw2sql($all['id']));
        $player->FirstName = $all['Nama'];
        $player->LastName = $all['NamaBelakang'];
        $player->PlayerNumber = Convert::raw2sql($all['NomorPunggung']);
        $player->write();


        return json_encode($player->toMap());
    }
    public function list()
    {
        $player = Player::get();
        return json_encode($player->toNestedArray());
    }
    public function delete(HTTPRequest $request)
    {
        // $params = $this->getURLParams();
        // $player = Player::get()->byID($params);
        $all = $request->requestVars();
        $player = Player::get()->byID(Convert::raw2sql($all['id']));
        $player->delete();
        return 'Delete success!';
    }

    // public function store()
    // {
    //     // return 'tes';
    //     $player = new Player();
    //     $player->FirstName = "Sam";
    //     $player->LastName = "Poerna";
    //     $player->PlayerNumber = 07;
    //     $player->write();

    //     return json_encode($player);
    // }




    // public function players(HTTPRequest $request)
    // {
    //     print_r($request->allParams());
    // }
    // public function someaction(HTTPRequest $request)
    // {
    //     $this->setResponse(new HTTPResponse());
    //     $this->getResponse()->setStatusCode(400);
    //     $this->getResponse()->setBody('invalid');

    //     return $this->getResponse();
    // }
    // public function getExample()
    // {
    //     return 'example';
    // }


    // public function Link($action = null)
    // {
    //     // Construct link with graceful handling of GET parameters
    //     $link = Controller::join_links('teams', $action);

    //     // Allow Versioned and other extension to update $link by reference.
    //     $this->extend('updateLink', $link, $action);

    //     return $link;
    // }
}
