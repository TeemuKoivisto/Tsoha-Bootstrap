<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TapahtumaController extends BaseController {

    public static function index() {
        $tapahtumat = Tilitapahtuma::all();

        Kint::dump($tapahtumat);

//        $tapahtumat = Tilitapahtuma::all();
        View::make('tapahtumat/index.html', array('tapahtumat' => $tapahtumat));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'opiskelija_id' => $params['opiskelija_id'],
            'pvm' => $params['pvm'],
            'maara' => $params['maara'],
            'kuvaus' => $params['kuvaus']
        );

        $tapahtuma = new Tilitapahtuma($attributes);
        $errors = $tapahtuma->errors();

        if (count($errors) != 0) {
            View::make('/tapahtumat/new.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tapahtuma->save();
            Redirect::to('/tapahtumat', array('message' => 'Tapahtuma lisätty'));
//        Redirect::to('/tapahtumat' . $tapahtuma->id, array('message' => 'Tapahtuma lisätty'));
        }
    }

    public static function create() {
        View::make('tapahtumat/new.html');
    }

    public static function edit($id) {
        $tapahtuma = Tilitapahtuma::find($id);
        View::make('tapahtumat/edit.html', array('attributes' => $tapahtuma));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'opiskelija_id' => $params['opiskelija_id'],
            'pvm' => $params['pvm'],
            'maara' => $params['maara'],
            'kuvaus' => $params['kuvaus']
        );

        $tapahtuma = new Tilitapahtuma($attributes);
        $errors = $tapahtuma->errors();

        if (count($errors) != 0) {
            View::make('/tapahtumat/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tapahtuma->update();
            Redirect::to('/tapahtumat', array('message' => 'Successful edit dawg.'));
        }
    }

    public static function destroy($id) {
        $tapahtuma = new Tilitapahtuma(array('id' => $id));
        $tapahtuma->destroy();

        Redirect::to('/tapahtumat', array('message' => 'Tapahtuma poistettu onnistuneesti.'));
    }

}
