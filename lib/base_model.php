<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate_nimi() {
        if ($this->nimi == '' || $this->nimi == null) {
            return 'Nimi ei saa olla tyhjä.';
        }
        if (strlen($this->nimi) > 50) {
            return 'Nimi ei saa olla yli 50 merkkiä pitkä.';
        }
    }
    
    public function validate_password() {
        if ($this->password == '' || $this->password == null) {
            return 'Salasana ei saa olla tyhjä. Helppo voi olla kuitenkin.';
        }
    }

    public function validate_opiskelija_id() {
        // lol turha
        if ($this->opiskelija_id == '' || $this->opiskelija_id == null) {
            return 'Id ei saa olla tyhjä.';
        }
    }
    
    public function validate_pvm() {
        $v = new Valitron\Validator(array('pvm' => $this->pvm));
        $v->rule('date', 'pvm');
        if (!$v->validate()) {
            return 'Päivämäärä oli väärää muotoa (yyyy-MM-dd)';
        }
    }

    public function validate_maara() {
        if ($this->maara == '' || $this->maara == null) {
            return 'Määrä ei saa olla tyhjä.';
        }
        if (!is_numeric($this->maara)) {
            return 'Määrä pitää olla numeroita. Daa.';
        }
    }

    public function validate_kuvaus() {
        if (strlen($this->kuvaus) > 200) {
            return 'Kuvaus ei saa olla yli 200 merkkiä pitkä.';
        }
    }

    public function errors() {
        $errors = array();

        foreach ($this->validators as $validator) {
            $validointi = $this->{$validator}();
            if (strlen($validointi) != 0) {
                $errors[] = $validointi;
            }
        }
        return $errors;
    }
}
