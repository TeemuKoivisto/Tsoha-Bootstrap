<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OpiskelijaController extends BaseController {
    
    public static function index() {
        $opiskelijat = Opiskelija::all();
        Kint::dump($opiskelijat);
        View::make('opiskelijat/index.html', array('opiskelijat' => $opiskelijat));
    }
    
    public static function show($id) {
        $opiskelija = Opiskelija::find($id);
        View::make('opiskelijat/:id', array('tapahtumat' => $opiskelija));
    }
}