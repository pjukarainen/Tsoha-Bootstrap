<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/frontpage', function() {
    HelloWorldController::index();
});


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});


$routes->get('/tournaments', function() {
    TournamentController::index();
});

$routes->get('/tournaments/new', 'check_logged_in', function() {
    TournamentController::create();
});

$routes->post('/tournaments', function() {
    TournamentController::store();
});


$routes->get('/tournaments/:id', function($id) {
    TournamentController::show($id);
});


$routes->get('/tournaments/:id/edit', 'check_logged_in', function($id) {
    TournamentController::edit($id);
});

$routes->post('/tournaments/:id/edit', 'check_logged_in', function($id) {
    TournamentController::update($id);
});

$routes->get('/tournaments/:id/top8', 'check_logged_in', function($id) {
    TournamentController::createTopEight($id);
});

$routes->post('/tournaments/:id', function() {

    TournamentController::store();
});


$routes->post('/tournaments/:id/destroy', 'check_logged_in', function($id) {
    TournamentController::destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/players', function() {
    PlayerController::index();
});

$routes->get('/players/new', 'check_logged_in', function() {
    PlayerController::create();
});

$routes->post('/players', function() {
    PlayerController::store();
});


$routes->get('/players/:id', function($id) {
    PlayerController::show($id);
});


$routes->get('/players/:id/edit', 'check_logged_in', function($id) {
    PlayerController::edit($id);
});

$routes->post('/players/:id/edit', 'check_logged_in', function($id) {
    PlayerController::update($id);
});


$routes->post('/players/:id/destroy', 'check_logged_in', function($id) {
    PlayerController::destroy($id);
});


