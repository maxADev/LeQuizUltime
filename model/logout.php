<?php 

require_once '../model/chargement.php';

App::getAuth()->logout();

App::redirect('../index.php');

?>