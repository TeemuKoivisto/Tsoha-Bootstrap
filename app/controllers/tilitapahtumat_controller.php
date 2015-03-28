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

        $tapahtuma = new Tilitapahtuma(array(
            'opiskelija_id' => $params['opiskelija_id'],
            'pvm' => $params['pvm'],
            'maara' => $params['maara'],
            'kuvaus' => $params['kuvaus']
        ));
        Kint::dump($tapahtuma);
        $tapahtuma->save();
        
        Redirect::to('/tapahtumat', array('message' => 'Tapahtuma lisätty'));
//        Redirect::to('/tapahtumat' . $tapahtuma->id, array('message' => 'Tapahtuma lisätty'));
    }
    
    public static function create() {
        View::make('tapahtumat/new.html');
    }
}
