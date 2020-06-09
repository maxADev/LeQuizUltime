<?php
class Bdd{

    private $pdo;

    // Fonction de construction qui permet la connexion a la base de données //
    public function __construct($login, $password, $database_name, $host ='localhost') {
    $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $this->pdo->query("SET NAMES UTF8");
    }

    // Création d'une methode, elle est publique donc ascéssible de partout //
    // query est une requête //
    // Reprends les paramettre d'une requête préparer, soit deux paramettrre //
    //Premier paramettre $query qui est la requête //
    //Deuxième paramttre les paramettre, les données envoyées, l'execute //
    // Return permet de renvoyer les résultats //
    public function query($query, $params = false) {
    // Verifie si oui ou non on fait une requête préparer avec donc avec des paramèttres //
        if($params) {
        $req = $this->pdo->prepare($query);
        $req->execute($params);
    } else {
        $req = $this->pdo->query($query);
    }
        return $req;
}
    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }
}
?>