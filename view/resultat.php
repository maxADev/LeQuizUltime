<?php

require_once '../model/chargement.php';

// Connexion a la base de donnée //
$bdd = App::getBdd();

// Permet la création de la session //
$session = Session::getInstance();

$gestion = new Gestion;

// Récupère l'utilisateur //
$users = App::getAuth();

// Permet de recupérer les infos de l'utilisateur //
$user = $users->user();

// Permet de recupérer l'ID de l'utilisateur //
$utilisateurs_id = $user->utilisateurs_id;

if(empty($utilisateurs_id)){
  Session::getInstance()->setFlash('danger', 'Euh faut faire le quiz pour voir les résultats');
  App::redirect('../index.php');
} else {

require_once 'header.php';
$utilisateurs_name = $user->utilisateurs_name;

//Permet d'avoir la question et la réponse et vérifie si c'est la bonne réponse //
$usersAnswer = $gestion->usersAnswer($bdd, $utilisateurs_id);

while ($donnesUtilisateurReponses = $usersAnswer->fetch()) {

  $count = $donnesUtilisateurReponses->count_good_answer;

  $resultat = 20;

  $pourcentage = $count / $resultat * 100;;

  echo '<div class="container animation-top text-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
          <div class="container">
            <h5 class="my-little-font">Les résultats du quiz pour '.$utilisateurs_name.'</h5>
          </div>
            <div class="container">
              <span class="my-little-font"> Nombre de bonnes réponses : '.$count.'</span>
            </div>
              <div class="container">
                <span class="my-little-font"> Pourcentage de réussite : '.$pourcentage.' % </span>
              </div>';
          if($pourcentage <= 30) {
            echo '<div class="container">
                    <span class="my-little-font"> Ah ouai moins de 30% de réussite ce n\'est pas ouff go recommencer</span>
                  </div>';
          }
          if($pourcentage > 30 && $pourcentage <= 60) {
            echo '<div class="container">
                    <span class="my-little-font"> Pas trop mal mais peux mieux faire</span>
                  </div>';
          }
          if($pourcentage > 60 && $pourcentage <= 90 ) {
            echo '<div class="container">
                    <span class="my-little-font"> Pas loin du sans faute dommage </span>
                  </div>';
          }
          if($pourcentage >= 90 && $pourcentage < 100  ) {
            echo '<div class="container">
                    <span class="my-little-font"> Presque un sans faute c\'est remarquable mais du coup t\'as fait des fautes donc ce n\'est pas ouff </span>
                  </div>';
          }
          if($pourcentage == 100){
            echo '<div class="container">
                    <span class="my-little-font"> Incroyable aucune faute </span>
                  </div>';
          }
          echo '<div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                  <div class="container col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
                    <a class="my-btn col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" href="../model/logout.php" type="submit">Quitter</a>
                  </div>
                </div>
        </div>';

}
}
App::getAuth()->logout();
?>