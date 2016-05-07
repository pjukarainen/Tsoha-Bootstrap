<?php

Class PlayerController extends BaseController {

    public static function index() {
        $players = Player::all();
        View::make('players/index.html', array('players' => $players));
    }

    public static function show($id) {
        $player = Player::find($id);
        View::make('players/player_info.html', array('player' => $player));
    }

    public static function create() {
        View::make('players/new.html');
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'handle' => $params['handle'],
            'name' => $params['name'],
            'sponsor' => $params['sponsor'],
            'country' => $params['country'],
            'points' => $params['points'],
            'description' => $params['description'],
            'characters' => $params['characters']
        );


        $player = new Player($attributes);
        $errors = $player->errors();

        if (count($errors) == 0) {
            $player->save();

            Redirect::to('/players/' . $player->id, array('message' => 'Player has been added succesfully'));
        } else {
            View::make('players/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $player = Player::find($id);
        View::make('players/edit.html', array('attributes' => $player));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'handle' => $params['handle'],
            'name' => $params['name'],
            'sponsor' => $params['sponsor'],
            'country' => $params['country'],
            'points' => $params['points'],
            'characters' => $params['characters'],
            'description' => $params['description']
        );



        $player = new Player($attributes);
        $errors = $player->errors();

        if (count($errors) > 0) {
            View::make('players/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $player->update($id);

            Redirect::to('/players/' . $player->id, array('message' => 'Player has been edited succesfully'));
        }
    }

    public static function destroy($id) {
        $player = new Player(array('id' => $id));
        $player->destroy($id);
        Redirect::to('/players', array('message' => 'Player has been deleted succesfully'));
    }

}
