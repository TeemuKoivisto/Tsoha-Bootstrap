<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OpiskelijaController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $opiskelija = self::get_user_logged_in();
        $tapahtumat = Tilitapahtuma::findEventsById($opiskelija->id);
        View::make('/opiskelija/index.html', array('tapahtumat' => $tapahtumat, 'opiskelija' => $opiskelija));
    }

    public static function show_all() {
        self::check_logged_in();
        self::check_if_admin();
        $opiskelijat = Opiskelija::all();
        View::make('opiskelija/all.html', array('opiskelijat' => $opiskelijat));
    }

    public static function show($id) {
        self::check_logged_in();
        self::check_if_admin();
        $opiskelija = Opiskelija::find($id);
        $tapahtumat = Tilitapahtuma::findEventsById($id);

        View::make('opiskelija/opiskelijadata.html', array('tapahtumat' => $tapahtumat, 'opiskelija' => $opiskelija));
    }

    public static function create() {
        self::check_logged_in();
        View::make('opiskelija/new.html');
    }

    public static function store() {
        $params = $_POST;

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

    public static function destroy($id) {
        $opiskelija = new Opiskelija(array('id' => $id));
        $tapahtumat = Tilitapahtuma::findEventsById($id);
        foreach ($tapahtumat as $tapahtuma) {
            Tapahtumakategoria::destroyEventById($id);
            $tapahtuma->destroy();
        }
        $opiskelija->destroy();
        
        Redirect::to('/opiskelijat', array('message' => 'Opiskelija poistettu onnistuneesti.'));
    }

    public static function login() {
        View::make('opiskelija/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $opiskelija = Opiskelija::authenticate($params['username'], $params['password']);
        if (!$opiskelija) {
            View::make('opiskelija/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $opiskelija->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $opiskelija->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

}
