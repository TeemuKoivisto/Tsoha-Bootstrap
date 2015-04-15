<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $opiskelija_id = $_SESSION['user'];
            $opiskelija = Opiskelija::find($opiskelija_id);
            return $opiskelija;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

}
