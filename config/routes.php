<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/opiskelija', function() {
    HelloWorldController::opiskelija();
});

$routes->get('/admin', function() {
    HelloWorldController::admin();
});

$routes->get('/tilinakyma', function() {
    HelloWorldController::tilinakyma();
});

/// uuddet >>>

$routes->get('/tapahtumat', function() {
    TapahtumaController::index();
});

$routes->post('/tapahtumat', function() {
    TapahtumaController::store();
});

$routes->get('/tapahtumat/new', function() {
    TapahtumaController::create();
});

$routes->get('/opiskelijat', function() {
    OpiskelijaController::index();
});

$routes->get('/opiskelijat/:id', function($id) {
    OpiskelijaController::show($id);
});

/*
Slim valitsee määrittämistäsi reiteistä ensimmäisen, joka vastaa pyynnön polkua.
Tällöin esimerkiksi pyyntö sovelluksen polkuun game/new saattaa mennä 
sekasin reitin game/:id-kanssa. Ongelman ratkaisu on määrittää reitti
game/new ennen reittiä game/:id.*/