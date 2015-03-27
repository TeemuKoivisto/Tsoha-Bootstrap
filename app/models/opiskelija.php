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
        
        foreach($rows as $row) {
            $opiskelija[] = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $opiskelija;
        }
        
        return null;
    }
}