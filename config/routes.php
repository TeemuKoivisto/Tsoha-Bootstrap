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
