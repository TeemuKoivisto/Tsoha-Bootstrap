<?php

class Tapahtumakategoria extends BaseModel{
    public $id, $kategoria, $tilitapahtuma;
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function findByEvent($id) {
        $query = DB::connection()->prepare('SELECT kategoria.id, nimi FROM Kategoria '
                . 'JOIN Tapahtumakategoria ON kategoria.id = '
                . 'tapahtumakategoria.kategoria WHERE tilitapahtuma = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $kategoriat = array();

        foreach ($rows as $row) {
            $kategoriat[] = new Kategoria(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $kategoriat;
    }
    
    public function findByCategory($ıd) {
        $query = DB::connection()->prepare('SELECT tilitapahtuma.id, opiskelija_id, '
                . 'pvm, maara, kuvaus FROM Tilitapahtuma JOIN Tapahtumakategoria ON '
                . 'tilitapahtuma.id = tapahtumakategoria.tilitapahtuma WHERE kategoria = :id');
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