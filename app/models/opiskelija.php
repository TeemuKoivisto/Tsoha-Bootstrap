<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Opiskelija extends BaseModel {
    
    public $id, $nimi, $tapahtumat;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }
    
    public static function all() {
        
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        $opiskelijat = array();
        
        foreach($rows as $row) {
            $opiskelijat[] = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        
        return $opiskelijat;
    }
    
    public static function find($id) {
        
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row) {
            $opiskelija = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $opiskelija;
        }
        
        return null;
    }
    
    public static function findEventsById($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tilitapahtuma WHERE opiskelija_id = ' .$id);
        $query->execute();
        $rows = $query->fetchAll();
        Kint::dump($query);
        Kint::dump($rows);
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
}