<?php require_once 'controller/class/Auth.php';
require_once 'controller/class/Bdd.php';
require_once 'controller/class/App.php';
require_once 'controller/class/Validation.php';
require_once 'controller/class/Session.php'; 

// Récupère l'utilisateur //
$users = App::getAuth();

// Permet de recupérer les infos de l'utilisateur //
$user = $users->user();

if($user){
  App::redirect('model/logout.php');
} else {

if($_POST){
    // Connexion a la base de donnée //
    $bdd = App::getBdd();

    $player = App::getAuth();   

    $validation = new Validation($_POST);

    $pseudo = $_POST['pseudo'];

    $validation_user_number_caract = $validation->correctCaractNumberUsersName('pseudo', 'Attention il faut entre 3 et 15 caractères');
        
    $validation_user_caract = $validation->isCaract('pseudo', 'Attention évitez les caractères spéciaux');

    $validation->isValid();

     $errors = $validation->getErrors();

    if(!empty($errors)) {
        $errors = $validation->getErrors();
        foreach($errors as $error){
        echo '<div class="alert alert-danger">
                 '.$error.'
                </div>';
        }
    } else {
        $users_uniq = $player->users_uniq($bdd, $pseudo);
    }
    if(empty($users_uniq) && !empty($_POST['pseudo'] && empty($errors))){
        // Permet de créer l'utilisateur //
        $creatPlayer = $player->register($bdd, $pseudo);
        // Permet la connexion //
        $username = $player->connect($bdd, $pseudo);
        App::redirect('view/game.php');
    } if(!empty($users_uniq)) {
        Session::getInstance()->setFlash('danger', 'Terrible le pseudo est déjà pris, faut changer');
        App::redirect('index.php');
    }
}
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Le Quiz Ultime</title>
        <link rel="stylesheet" href="public/style/style.css">
        <link rel="stylesheet" href="public/style/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
        <meta name="description" content="Quiz composé de question absurde mais bon si tu as du temps a perds" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body> 
<?php
echo '<div class="container text-center col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="container col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <h1 class="text-center mt-5 flux">LE QUIZ ULTIME</h1>
    </div>
    <div class="container col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-5 mb-5">
        <span class="my-little-font">Quiz composé de 20 questions qui n\'ont aucun intérêt, mais fais le quand même si tu t\'ennuies.</span>
        <span class="my-little-font">Un peu d\'ironie demandée.</span>
    </div>';


    echo '<div class="container form-group col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
            <form method="POST"">
                <div class="container mb-1">
                    <label class="my-little-font">Un pseudo et joue</label>
                    <input class="form-control col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" name="pseudo" placeholder="pseudo"></input>
                </div>
                    <div class="container">
                        <button class="btn btn-primary col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" href="view/game.php" type="submit">Lancer le quiz</button>
                    </div>
            </form>
        </div>';
echo '<div class="container"> ';
// Gère les messages d'erreurs //
        if(Session::getInstance()->hasFlash()){
            foreach(Session::getInstance()->getFlash() as $type => $message){ 
            echo '<div class="alert alert-'.$type.'">
            '.$message.'
            </div>';
      
}
}
echo '</div>
</div>';
?>
</body>
</html>