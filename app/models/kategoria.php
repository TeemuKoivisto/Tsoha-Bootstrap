<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Kategoria extends BaseModel {

    public $id, $nimi;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kategoria ORDER BY nimi');
        $query->execute();
        $rows = $query->fetchAll();
        
        $kategoriat = array();
        
        foreach($rows as $row) {
            $kategoriat[] = new Kategoria( array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        return $kategoriat;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kategoria WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kategoria = new Kategoria(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            return $kategoria;
        }

        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kategoria'
                . '(nimi)'
                . 'VALUES (:nimi)'
                . 'RETURNING id');

        $query->execute(array('nimi' => $this->nimi));
        
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Kategoria SET nimi = :nimi'
                . ' WHERE ID = :id');

        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Kategoria WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
}
