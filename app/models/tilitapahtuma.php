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
        $this->validators = array('validate_opiskelija_id', 'validate_pvm', 'validate_maara', 'validate_kuvaus');
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

    public static function findEventsAndCategoryById($id) {
        $tapahtumat = Tilitapahtuma::findEventsById($id);
        $tjak = array();
        
        foreach ($tapahtumat as $tapahtuma) {
            $kategoriat = Tapahtumakategoria::findByEvent($tapahtuma->id);
            $tjak[] = array('tapahtuma' => $tapahtuma, 'kategoriat' => $kategoriat);
        }
        return $tjak;
        
        // lol =>
//        $query = DB::connection()->prepare('SELECT nimi AS kategoria_nimi, pvm, maara, '
//                . 'kuvaus FROM Tapahtumakategoria JOIN Kategoria ON kategoria.id = '
//                . 'tapahtumakategoria.kategoria JOIN Tilitapahtuma ON tilitapahtuma.id '
//                . '= tapahtumakategoria.tilitapahtuma WHERE opiskelija_id = :id');
    }
    
    public static function findEventsById($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tilitapahtuma WHERE opiskelija_id = :id');
        $query->execute(array('id' => $id));
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

    public static function findEventsByCategoryAndId($id, $opiskelija) {
        $query = DB::connection()->prepare('SELECT * FROM Tilitapahtuma WHERE opiskelija_id = :opiskelija '
                . 'AND tilitapahtuma.id IN (SELECT tapahtumakategoria.tilitapahtuma FROM tapahtumakategoria '
                . 'WHERE tapahtumakategoria.kategoria = :id)');
        $query->execute(array('id' => $id, 'opiskelija' => $opiskelija));
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
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tilitapahtuma'
                . '(opiskelija_id, pvm, maara, kuvaus)'
                . 'VALUES (:opiskelija_id, :pvm, :maara, :kuvaus)'
                . 'RETURNING id');

        $query->execute(array('opiskelija_id' => $this->opiskelija_id,
            'pvm' => $this->pvm, 'maara' => $this->maara,
            'kuvaus' => $this->kuvaus));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Tilitapahtuma SET pvm = :pvm,'
                . ' maara = :maara, kuvaus = :kuvaus WHERE ID = :id');

        $query->execute(array('id' => $this->id, 'pvm' => $this->pvm,
            'maara' => $this->maara, 'kuvaus' => $this->kuvaus));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tilitapahtuma WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
}
