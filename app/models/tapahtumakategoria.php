<?php

class Tapahtumakategoria extends BaseModel{
    public $id, $kategoria, $tilitapahtuma;
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tapahtumakategoria '
                . '(kategoria, tilitapahtuma) VALUES (:kategoria, :tilitapahtuma) '
                . 'RETURNING id');
        $query->execute(array('kategoria' => $this->kategoria, 'tilitapahtuma' => $this->tilitapahtuma));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function destroyEventById($tapahtuma){
        $query = DB::connection()->prepare('DELETE FROM Tapahtumakategoria WHERE tilitapahtuma = :tapahtuma');
        $query->execute(array('tapahtuma' => $tapahtuma));
    }
    
    public function destroyCategoryById($kategoria) {
        $query = DB::connection()->prepare('DELETE FROM Tapahtumakategoria WHERE kategoria = :kategoria');
        $query->execute(array('kategoria' => $kategoria));
    }
    
    public function createConnections($tapahtuma_id, $kategoriat) {
        if($kategoriat==null) return;
        
        foreach($kategoriat as $kategoria) {
            $tapahtumakategoria = new Tapahtumakategoria(array(
                'kategoria' => $kategoria,
                'tilitapahtuma' => ($tapahtuma_id)
            ));
            $tapahtumakategoria->save();
        }
    }
}