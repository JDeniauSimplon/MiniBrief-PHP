<?php 

class DBManager {
    private $bdd;

    public function __construct() {
        try {
            $this->bdd = new PDO (
                'mysql:host=localhost;dbname=todo;charset=utf8',
                'root',
                'root'
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getConnexion() {
        return $this->bdd;
    }
}

?>