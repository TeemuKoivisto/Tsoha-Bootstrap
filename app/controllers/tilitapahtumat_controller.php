<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TapahtumaController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $opiskelija = self::get_user_logged_in();
        $tjak = Tilitapahtuma::findEventsAndCategoryById($opiskelija->id);
        View::make('tapahtumat/index.html', array('tjak' => $tjak));
    }

    public static function show_all() {
        self::check_logged_in();
        $tapahtumat = Tilitapahtuma::all();
        View::make('tapahtumat/all.html', array('tapahtumat' => $tapahtumat));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'opiskelija_id' => self::get_user_logged_in()->id,
            'pvm' => $params['pvm'],
            'maara' => $params['maara'],
            'kuvaus' => $params['kuvaus']
        );

        $tapahtuma = new Tilitapahtuma($attributes);
        $errors = $tapahtuma->errors();

        if (count($errors) != 0) {
            $kategoriat = Kategoria::all();
            View::make('/tapahtumat/new.html', array('errors' => $errors, 'attributes' => $attributes, 'kategoriat' => $kategoriat));
        } else {
            $tapahtuma->save();
            Tapahtumakategoria::createConnections($tapahtuma->id, $params['kategoriat']);
            Redirect::to('/tapahtumat', array('message' => 'Tapahtuma lisätty'));
        }
    }

    public static function create() {
        self::check_logged_in();
        $kategoriat = Kategoria::all();
        View::make('tapahtumat/new.html', array('kategoriat' => $kategoriat));
    }

    public static function edit($id) {
        self::check_logged_in();
        $tapahtuma = Tilitapahtuma::find($id);
        $kategoriat = Kategoria::all();
        View::make('tapahtumat/edit.html', array('attributes' => $tapahtuma, 'kategoriat' => $kategoriat));
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'opiskelija_id' => self::get_user_logged_in()->id,
            'pvm' => $params['pvm'],
            'maara' => $params['maara'],
            'kuvaus' => $params['kuvaus']
        );

        $kategoriat = Kategoria::all();
        $tapahtuma = new Tilitapahtuma($attributes);
        $errors = $tapahtuma->errors();

        if (count($errors) != 0) {
            $kategoriat = Kategoria::all();
            View::make('/tapahtumat/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'kategoriat' => $kategoriat));
        } else {
//            Tapahtumakategoria::destroyByEventId($id);
            $tapahtuma->update();
//            if (array_key_exists('kategoriat', $params)) {
//                Tapahtumakategoria::createConnetion($id, $params['kategoriat']);
//            }
            Redirect::to('/tapahtumat', array('message' => 'Tapahtumaa muokattu onnistuneesti.'));
        }
    }

    public static function destroy($id) {
        $tapahtuma = new Tilitapahtuma(array('id' => $id));
        $tapahtuma->destroy();
        Tapahtumakategoria::destroyEventById($id);
        Redirect::to('/tapahtumat', array('message' => 'Tapahtuma poistettu onnistuneesti.'));
    }

}
