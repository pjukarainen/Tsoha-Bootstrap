<?php

class TournamentController extends BaseController {

    public static function index() {
        $tournaments = Tournament::all();
        View::make('tournaments/index.html', array('tournaments' => $tournaments));
    }

    public static function show($id) {
        $tournament = Tournament::find($id);
        View::make('tournaments/tournament_info.html', array('tournament' => $tournament));
    }

  

    public static function store() {
        $params = $_POST;

        $tournament = new Tournament(array(
            'name' => $params['name'],
            'held' => $params['held'],
            'location' => $params['location'],
            'status' => $params['status'],
            'region' => $params['region'],
            'description' => $params['description']
        ));

//        Kint::dump($params);

        $tournament->save();

        Redirect::to('/tournaments/' . $tournament->id, array('message' => 'Tournament has been added succesfully'));
    }

    public static function create() {
        View::make('/tournaments/new.html');
    }

}
