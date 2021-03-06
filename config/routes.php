<?php

$routes->get('/', function() {
    OpiskelijaController::frontpage();
});

$routes->get('/login', function() {
    OpiskelijaController::login();
});

$routes->post('/login', function() {
    OpiskelijaController::handle_login();
});

$routes->get('/logout', function() {
    OpiskelijaController::logout();
});

$routes->get('/opiskelija/new', function() {
    OpiskelijaController::create();
});

$routes->post('/', function() {
    OpiskelijaController::store();
});

// opiskelijan ja admnin viewit

$routes->get('/opiskelija', function() {
    OpiskelijaController::index();
});

$routes->get('/tapahtumat', function() {
    TapahtumaController::index();
});

$routes->get('/tapahtumat/new', function() {
    TapahtumaController::create();
});

$routes->post('/tapahtumat', function() {
    TapahtumaController::store();
});

$routes->get('/tapahtumat/:id/edit', function($id) {
    TapahtumaController::edit($id);
});

$routes->post('/tapahtumat/:id/edit', function($id) {
    TapahtumaController::update($id);
});

$routes->post('/tapahtumat/:id/destroy', function($id) {
    TapahtumaController::destroy($id);
});

$routes->get('/kategoria', function() {
    KategoriaController::index();
});

$routes->get('/kategoria/new', function() {
    KategoriaController::create();
});

$routes->post('/kategoria', function() {
    KategoriaController::store();
});

$routes->get('/kategoria/:id', function($id) {
    KategoriaController::show($id);
});

$routes->get('/kategoria/:id/edit', function($id) {
    KategoriaController::edit($id);
});

$routes->post('/kategoria/:id/edit', function($id) {
    KategoriaController::update($id);
});

$routes->post('/kategoria/:id/destroy', function($id) {
    KategoriaController::destroy($id);
});

// vain adminin

$routes->get('/alltapahtumat', function() {
    TapahtumaController::show_all();
});

$routes->get('/opiskelijat', function() {
    OpiskelijaController::show_all();
});

$routes->get('/opiskelijat/:id', function($id) {
    OpiskelijaController::show($id);
});

$routes->post('/opiskelijat/:id/destroy', function($id) {
    OpiskelijaController::destroy($id);
});

//kenties turha. miks yksittäistä tapahtumaa tarttis tarkastella?
//$routes->get('/alltapahtumat/:id', function($id) {
//    TapahtumaController::show($id);
//});

/*
Slim valitsee määrittämistäsi reiteistä ensimmäisen, joka vastaa pyynnön polkua.
Tällöin esimerkiksi pyyntö sovelluksen polkuun game/new saattaa mennä 
sekasin reitin game/:id-kanssa. Ongelman ratkaisu on määrittää reitti
game/new ennen reittiä game/:id.*/