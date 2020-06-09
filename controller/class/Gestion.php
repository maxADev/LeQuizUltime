<?php

class Gestion {

    public function question($bdd){
        return $bdd->query("SELECT * FROM questions");
    }

    public function reponse($bdd, $question_id){
        return $bdd->query("SELECT * FROM reponse  WHERE question_idFK = ?",[$question_id]);
    }

    public function envoie($bdd, $question_id, $reponse_id, $utilisateurs_id){
        $bdd->query('INSERT INTO utilisateurs_reponses SET utilisateurs_reponses_question = ?, utilisateurs_reponses_name = ?, utilisateurs_idFK = ?',[$question_id, $reponse_id, $utilisateurs_id]);
    }

    public function envoie_verification($bdd, $reponse_id, $question_id){
        return $bdd->query('SELECT * FROM reponse WHERE reponse_id = ? AND question_idFK = ?',[$reponse_id, $question_id])->fetch();
    }

    public function bonneReponse($bdd){
        return $bdd->query("SELECT * FROM questions  WHERE reponse_statut = 1");
    }

    public function usersAnswer($bdd, $usersId){
        return $bdd->query("SELECT *, COUNT(*) AS count_good_answer FROM questions LEFT JOIN utilisateurs_reponses ON utilisateurs_reponses.utilisateurs_reponses_question = questions.question_id LEFT JOIN reponse ON utilisateurs_reponses.utilisateurs_reponses_name = reponse.reponse_id  WHERE utilisateurs_idFK = ? AND reponse_statut = 1", [$usersId]);
    }

    public function users_answer_uniq($bdd, $users_id){
        return $bdd->query("SELECT utilisateurs_reponses_question FROM utilisateurs_reponses WHERE utilisateurs_idFK = ?",[$users_id])->fetch();
    }

    public function users_answer_delete($bdd, $users_id){
        return $bdd->query("DELETE FROM utilisateurs_reponses
        WHERE utilisateurs_idFK = ?",[$users_id]);
    }

}

?>