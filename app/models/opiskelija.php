<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opiskelija extends BaseModel {

    public $id, $nimi, $password, $yllapitaja;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_password');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija');
        $query->execute();

        $rows = $query->fetchAll();
        $opiskelijat = array();

        foreach ($rows as $row) {
            $opiskelijat[] = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'yllapitaja' => $row['yllapitaja']
            ));
        }

        return $opiskelijat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $opiskelija = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'yllapitaja' => $row['yllapitaja']
                    
            ));
            return $opiskelija;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Opiskelija'
                . '(nimi, password) VALUES (:nimi, :password)'
                . 'RETURNING id');

        $query->execute(array('nimi' => $this->nimi, 'password' => $this->password));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Opiskelija WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
    public static function authenticate($nimi, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE nimi = :nimi AND password = :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));

        $row = $query->fetch();

        if ($row) {
            $opiskelija = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'yllapitaja' => $row['yllapitaja']
            ));
            return $opiskelija;
        } else {
            return null;
        }
    }

}
