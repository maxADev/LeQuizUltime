<?php

class Session {

    static $instance;
    // Permet de verifier et de ne pas lancer une nouvelle session //
    // Permet d'avoir une seule fois //
    static function getInstance() {
        if(!self::$instance){
        self::$instance = new Session();
    }   return self::$instance;
}

    public function __construct() {
        session_start();
    }

    // Ecrit les messages flash //
    public function setFlash($type, $message) {
        $_SESSION['flash'][$type] = $message;
}

    // Verfie si il y a des messages flash //
    public function hasFlash() {
        return isset($_SESSION['flash']);
}

    // Renvoi tout les message flash //
    public function getFlash() {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
}
    
    // Permet d'écrire dans la variable $_SESSION //
    public function write($key, $value) {
        $_SESSION[$key] = $value;
    }
    // Permet de lire la variable $_SESSION PRESENTATION EN TERNAIRE //
    public function read($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

    // Permet de vider la $_SESSION //
    public function delete($key){
        unset($_SESSION[$key]);
    }

}












?>