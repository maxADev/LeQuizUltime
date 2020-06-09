<?php
require_once '../model/chargement.php';

// Connexion a la base de donnée //
$bdd = App::getBdd();

// Permet la création de la session //
$session = Session::getInstance();

// Récupère l'utilisateur //
$users = App::getAuth();

$gestion = new Gestion;

$question = $gestion->question($bdd);

while ($donnees = $question->fetch()){

$question_id = $donnees->question_id;

// Permet de recupérer les infos de l'utilisateur //
$user = $users->user();

$utilisateurs_id = $user->utilisateurs_id;
// Permet d'envoyer tout les bouton radio de façon incrémenté //

$reponse_id = $_POST['choixReponse'.$question_id];

if(empty($_POST['choixReponse'.$question_id])){
    Session::getInstance()->setFlash('danger', 'Tu n\'as pas répondu à une ou plusieurs questions du coup faut recommencer');
    $users_answer_delete = $gestion->users_answer_delete($bdd, $utilisateurs_id);
    App::redirect('../view/game.php');
} if(!is_numeric($reponse_id)){
    Session::getInstance()->setFlash('danger', 'Pas touche au code');
    App::redirect('../model/logout.php');
} else {
    $reponse_verification = $gestion->envoie_verification($bdd, $reponse_id, $question_id);
} if(empty($reponse_verification)){
    Session::getInstance()->setFlash('danger', 'Pas touche au code');
    App::redirect('../model/logout.php');
} else {
    // Permet d'envoyer les réponses de l'utilisateur //
    $envoie = $gestion->envoie($bdd, $question_id, $reponse_id, $utilisateurs_id);
}
}

App::redirect('../view/resultat.php');

?>