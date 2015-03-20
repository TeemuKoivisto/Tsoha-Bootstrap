<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
	public static function login() {
		View::make('suunnitelmat/login.html');
	}
	
	public static function opiskelija() {
		View::make('suunnitelmat/opiskelija.html');
	}
	
	public static function admin() {
		View::make('suunnitelmat/admin.html');
	}
	
	public static function tilinakyma() {
		View::make('suunnitelmat/tilinakyma.html');
	}
  }
