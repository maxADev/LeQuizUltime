<?php

class Validation {

    private $errors = [];
    private $data;

    
// $data correspond au donnée que l'on vas verifier
public function __construct($data) {
    $this->data = $data;
}

// Permet de verifier si un champs est vide //
private function getField($field) {
    if(!isset($this->data[$field])) {
    return null;
}
    return $this->data[$field];
}

public function isCaract($field, $errorMsg) {
    if(!preg_match("/^[a-zA-Z0-9]+$/", $this->getField($field))) {
    $this->errors[$field] = $errorMsg;
}}

public function correctCaractNumberUsersName($field, $errorMsg = '') {
    $value = $this->getField($field);
    if(strlen($value) < 3 || strlen($value) > 15) {
    $this->errors[$field] = $errorMsg;
    }
}

// Verifie si les erreurs sont vide //
public function isValid(){
    return empty($this->errors);
}

public function getErrors(){
    return $this->errors;
}

}

?>