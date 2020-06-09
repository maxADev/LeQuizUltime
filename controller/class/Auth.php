<?php

class Auth {

// Tableau d'options pour les messages flash //
private $options = [
    'restriction_msg' => "Vous devez être connecté pour accéder à votre compte"
];

private $session;

// Fusionne le tableau avec celui passé en paramettre //
// Permet de lancer la session grace au paramettre, la session est lancé grace app.php //
public function __construct($session, $options = []){
$this->options = array_merge($this->options, $options);
$this->session = $session;
}

public function users_uniq($bdd, $users_name){
    return $bdd->query("SELECT * FROM utilisateurs WHERE utilisateurs_name = ?", [$users_name])->fetch();
}

// Insertion dans la base de donnée de l'utilisateur //
public function register($bdd, $pseudo){
    $bdd->query('INSERT INTO utilisateurs SET utilisateurs_name = ?',[$pseudo]);
 }

// Permet la connexion ecrit les infos de l'utilisateur dans la variabl $_SESSION['auth] //
public function connection($user){
    $this->session->write('auth', $user);
}

// Verifie si on a déjà un utilisateur
public function user(){
    if(!$this->session->read('auth')) {
        return false;
    }   return $this->session->read('auth');
}

// Permet d'aller chercher l'utilisateur et de verifier le mot de passe permet la connexion //
public function connect($bdd, $pseudo) {
    $user = $bdd->query('SELECT * FROM utilisateurs WHERE utilisateurs_name = ?', [$pseudo])->fetch();
    if($user) {
        $this->connection($user);
        return $user;
} else {
        return false;
}}

 // Permet de deconecter //
 public function logout(){
    $this->session->delete('auth');
}

}

?>