<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/frontpage', function() {
    HelloWorldController::index();
});


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/tournaments', function() {
    TournamentController::index();
});

$routes->get('/tournaments/new', function() {
    TournamentController::create();
});

$routes->post('/tournaments', function() {
    TournamentController::store();
});


$routes->get('/tournaments/:id', function($id) {
    TournamentController::show($id);
});


$routes->get('/tournaments/:id/edit', function($id) {
    TournamentController::edit($id);
});

$routes->post('/tournaments/:id/edit', function($id) {
    TournamentController::update($id);
});


$routes->post('/tournaments/:id/destroy', function($id) {
    TournamentController::destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->get('/players', function() {
    HelloWorldController::player_list();
});

$routes->get('/players/1', function() {
    HelloWorldController::player_info();
});

$routes->get('/players/modify/1', function() {
    HelloWorldController::player_modify();
});

$routes->get('/tournaments/modify/1', function() {
    HelloWorldController::tournament_modify();
});


