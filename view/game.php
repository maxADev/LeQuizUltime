<?php
require_once '../model/chargement.php';

// Connexion a la base de donnée //
$bdd = App::getBdd();

$gestion = new Gestion;

$question = $gestion->question($bdd);

$a = 0;

$player = App::getAuth();

// Permet la création de la session //
$session = Session::getInstance();

// Récupère l'utilisateur //
$users = App::getAuth();

// Permet de recupérer les infos de l'utilisateur //
$user = $users->user();

$utilisateurs_id = $user->utilisateurs_id;

if(empty($utilisateurs_id)){
  Session::getInstance()->setFlash('danger', 'Euh tu peux pas faire le quiz si tu n\'es pas connecté');
  App::redirect('../index.php');
} else {
  require_once 'header.php';
  echo '<h1 class="text-center mt-5 mb-2 my-font" id="numeroQuesiton">Question 1</h1>';
  echo '<div class="container">';
        // Gère les messages d'erreurs //
        if(Session::getInstance()->hasFlash()){
            foreach(Session::getInstance()->getFlash() as $type => $message){ 
            echo '<div class="alert alert-'.$type.'">
            '.$message.'
            </div>';
}
}
echo '</div>';

echo "<h5 class='text-center'>$user->utilisateurs_name est en train de répondre</h5>";
echo "<div class='container text-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5'>";

// Permet d'afficher les questions //
while ($donnees = $question->fetch()){

// Incrément le numéro de la question //
$a++;

// Permet de récupérer chaque id de question //
$question_id = $donnees->question_id;

// Permet d'aller chercher les réponses //
$reponse = $gestion->reponse($bdd, $question_id);

echo "<form method='POST' action='../model/envoieReponses.php'>
  <div id='Question$a' class='displayOff'>
    <div class='container my-border text-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
      <span class='my-little-font'>$donnees->question_name</span>
    </div>
      <h5 class='text-center mt-5 mb-5'>Les réponses : </h5>
        <div class='container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row m-0'>";
          while($donneesReponse = $reponse->fetch()){
           echo "<div class='question-container col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4'>
                  <div class='button-wrap'>
                    <input class='choice hidden radio-label col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12' name='choixReponse$question_id' type='radio' value='$donneesReponse->reponse_id' id='reponse$donneesReponse->reponse_id'/>
                    <label class='button-label col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12' for='reponse$donneesReponse->reponse_id'><h1 class='my-little-font'>$donneesReponse->reponse_name</h1></label>
                  </div>
                </div>";
      }
      echo "</div>
      </div>";
      }
      echo "<div class='container text-center col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mt-5 mb-5'>
              <button id='envoyez' type='submit' class='envoyez my-btn col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>Valider mes réponses </button>
            </div>
      </form>
</div>";

echo '<div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-5">
        <div class="row">
        <div class="container col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-5">
          <button class="displayOff col-12 my-btn" id="returnQuestion">Retour</button>
        </div>
          <div class="container col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
              <button class="col-12 my-btn" id="nextQuestion" >Question suivante</button>
          </div>
      </div>
</div>';
}
?>
</body>
<footer>
<script src="../public/script/script.js"></script>
</footer>