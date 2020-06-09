<?php

spl_autoload_register('mon_autoloder');

// Permet d'aller chercher automatiquement les fichers //
// class correspond au ficher ou l'on vas aller chercher les fichiers //
    function mon_autoloder($class) {
        require_once "../controller/class/$class.php";
}

?>