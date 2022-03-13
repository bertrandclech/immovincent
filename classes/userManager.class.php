<?php
require_once 'bdd.class.php';
/**
 * USER Manager
 */
class UserManager extends BDD {

    /**
     * [Connecteur de BDD]
     * @var PDO
     */
    private $bdd;

    // Constructeur de la classe et récupération du connecteur de BDD
    // On peut l'utiliser directement mais de cette manière si un changement d'héritage
    // il ne faudra pas reécrire toutes les méthodes
    public function __construct() { $this->bdd = $this->pdo(); }

    /**
     * [Save a User in Db]
     * @param User $user
     */
    public function add(User $user) {

    }        

}    