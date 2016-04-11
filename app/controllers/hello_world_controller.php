<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('suunnitelmat/start_page.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        $testi = Tournament::find(1);
        $tournaments = Tournament::all();

        Kint::dump($testi);
        Kint::dump($tournaments);
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function tournament_list() {
        View::make('suunnitelmat/tournament_list.html');
    }

    public static function player_list() {
        View::make('suunnitelmat/player_list.html');
    }

    public static function tournament_info() {
        View::make('suunnitelmat/tournament_info.html');
    }

    public static function tournament_modify() {
        View::make('suunnitelmat/tournament_modify.html');
    }

    public static function player_modify() {
        View::make('suunnitelmat/player_modify.html');
    }

    public static function player_info() {
        View::make('suunnitelmat/player_info.html');
    }

}
