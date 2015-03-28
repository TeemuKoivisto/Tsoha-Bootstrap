<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tilitapahtuma extends BaseModel {

    public $id, $opiskelija_id, $pvm, $maara, $kuvaus;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Tilitapahtuma');

        $query->execute();

        $rows = $query->fetchAll();
        $tapahtumat = array();

        foreach ($rows as $row) {
            $tapahtumat[] = new Tilitapahtuma(array(
                'id' => $row['id'],
                'opiskelija_id' => $row['opiskelija_id'],
                'pvm' => $row['pvm'],
                'maara' => $row['maara'],
                'kuvaus' => $row['kuvaus']
            ));
        }

        return $tapahtumat;
    }

    public static function find($id) {

        $query = DB::connection()->prepare('SELECT * FROM Tilitapahtuma WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tapahtuma = new Tilitapahtuma(array(
                'id' => $row['id'],
                'opiskelija_id' => $row['opiskelija_id'],
                'pvm' => $row['pvm'],
                'maara' => $row['maara'],
                'kuvaus' => $row['kuvaus']
            ));
            return $tapahtuma;
        }

        return null;
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Tilitapahtuma'
                . '(opiskelija_id, pvm, maara, kuvaus)'
                . 'VALUES (:opiskelija_id, :pvm, :maara, :kuvaus)'
                . 'RETURNING id');
        
        $query->execute(array('opiskelija_id' => $this->opiskelija_id, 
            'pvm' => $this->pvm, 'maara' => $this->maara,
            'kuvaus' => $this->kuvaus));
//        
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}
