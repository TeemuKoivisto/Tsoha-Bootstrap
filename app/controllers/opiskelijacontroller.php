<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OpiskelijaController extends BaseController {

    public static function index() {
        $opiskelija = self::get_user_logged_in();
        if ($opiskelija) {
            $tapahtumat = Tilitapahtuma::findEventsById($opiskelija->id);
            View::make('/opiskelija/opiskelija.html', array('tapahtumat' => $tapahtumat, 'opiskelija' => $opiskelija));
        } else {
            Redirect::to('/', array('message' => 'Kirjaudu sisään tai luo uusi käyttäjä!'));
        }
    }

    public static function show_all() {
        $opiskelijat = Opiskelija::all();
        Kint::dump($opiskelijat);
        View::make('opiskelija/opiskelijat.html', array('opiskelijat' => $opiskelijat));
    }

    public static function show($id) {
        $opiskelija = Opiskelija::find($id);
        $tapahtumat = Tilitapahtuma::findEventsById($id);

        Kint::dump($opiskelija);
        Kint::dump($tapahtumat);

        View::make('opiskelija/opiskelijadata.html', array('tapahtumat' => $tapahtumat, 'opiskelija' => $opiskelija));
    }

    public static function create() {
        View::make('opiskelija/new.html');
    }

    public static function store() {
        $params = $_POST;
//        $errors = array();
//        $opiskelija;
//        
//        if ($params['password'] === $params['password2']) {
//            $attributes = array(
//                'nimi' => $params['nimi'],
//                'password' => $params['password']
//            );
//            $opiskelija = new Opiskelija($attributes);
//            $errors = $opiskelija->errors();
//        } else {
//            $errors[] = 'Salasana ei täsmää.';
//        }

        $attributes = array(
            'nimi' => $params['nimi'],
            'password' => $params['password']
        );
        $opiskelija = new Opiskelija($attributes);
        $errors = $opiskelija->errors();

        if (count($errors) != 0) {
            View::make('/opiskelija/new.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $opiskelija->save();
            Redirect::to('/opiskelija', array('message' => 'Uusi käyttäjä luotu'));
        }
    }

    public static function login() {
        View::make('opiskelija/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $opiskelija = Opiskelija::authenticate($params['username'], $params['password']);
        Kint::dump($opiskelija);
        if (!$opiskelija) {
            View::make('opiskelija/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $opiskelija->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $opiskelija->nimi . '!'));
        }
    }

}
