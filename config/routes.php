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
    HelloWorldController::tournament_list();
});

$routes->get('/tournaments/1', function() {
    HelloWorldController::tournament_info();
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


