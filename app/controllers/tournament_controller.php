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

        $attributes = array(
            'name' => $params['name'],
            'held' => $params['held'],
            'location' => $params['location'],
            'status' => $params['status'],
            'region' => $params['region'],
            'description' => $params['description']
        );

        $tournament = new Tournament($attributes);
        $errors = $tournament->errors();

        if (count($errors) == 0) {
            $tournament->save();

            Redirect::to('/tournaments/' . $tournament->id, array('message' => 'Tournament has been added succesfully'));
        } else {
            View::make('tournaments/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        View::make('/tournaments/new.html');
    }

    public static function edit($id) {
        $tournament = Tournament::find($id);
        View::make('tournaments/edit.html', array('attributes' => $tournament));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'held' => $params['held'],
            'location' => $params['location'],
            'status' => $params['status'],
            'region' => $params['region'],
            'description' => $params['description']
        );


        $tournament = new Tournament($attributes);
        $errors = $tournament->errors();

        if (count($errors) > 0) {
            View::make('tournaments/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tournament->update($id);

            Redirect::to('/tournaments/' . $tournament->id, array('message' => 'Tournament has been edited succesfully'));
        }
    }

   

    public static function destroy($id) {
        $tournament = new Tournament(array('id' => $id));
        $tournament->destroy($id);
        Redirect::to('/tournaments', array('message' => 'Tournament has been deleted succesfully'));
    }

}
