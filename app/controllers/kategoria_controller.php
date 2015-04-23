<?php

class KategoriaController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $opiskelija = self::get_user_logged_in();
        $kategoriat = Kategoria::all();
        View::make('kategoria/index.html', array('kategoriat' => $kategoriat));
    }

    public static function show($id) {
        self::check_logged_in();
        $tapahtumat = Tilitapahtuma::findEventsByCategoryAndId($id, self::get_user_logged_in()->id);
        View::make('kategoria/all.html', array('tapahtumat' => $tapahtumat));
    }
    
    public static function show_all() {
        self::check_logged_in();
        $tapahtumat = Kategoria::all();
        View::make('kategoria/all.html', array('tapahtumat' => $tapahtumat));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi']
        );

        $kategoria = new Kategoria($attributes);
        $errors = $kategoria->errors();

        if (count($errors) != 0) {
            View::make('/kategoria/new.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kategoria->save();
            Redirect::to('/kategoria', array('message' => 'Kategoria luotu'));
        }
    }

    public static function create() {
        self::check_logged_in();
        self::check_if_admin();
        View::make('kategoria/new.html');
    }

    public static function edit($id) {
        self::check_logged_in();
        self::check_if_admin();
        $kategoria = Kategoria::find($id);
        View::make('kategoria/edit.html', array('attributes' => $kategoria));
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi']
        );

        $kategoria = new Kategoria($attributes);
        $errors = $kategoria->errors();

        if (count($errors) != 0) {
            View::make('/kategoria/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kategoria->update();
            Redirect::to('/kategoria', array('message' => 'Kategoriaa muokattu onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        self::check_if_admin();
        $kategoria = new Kategoria(array('id' => $id));
        $kategoria->destroy();
        Tapahtumakategoria::destroyCategoryById($id);
        Redirect::to('/kategoria', array('message' => 'Kategoria poistettu onnistuneesti.'));
    }

}
