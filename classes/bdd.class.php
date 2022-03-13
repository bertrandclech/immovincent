<?php
/**
 * Permet de gérer la connexion PDO
 */
class BDD {
	// Nom de la base de données
	private const DBNAME = 'real_estate_2';
	// Où est située la base de données ?
	private const HOST = 'localhost';
	// Nom d'utilisateur
	private const USER = 'root';
	// Mot de passe de connexion
	private const PASSWORD = '';

	/**
	 * Permet de se connecter à la base de données
	 * @return PDO
	 */
	protected function pdo()
	{
		// Les deux doubles points est un opérateur de résolution de portée (Paamayim Nekudotayim)
		// https://www.php.net/manual/fr/language.oop5.paamayim-nekudotayim.php
		try {
			$bdd = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME . ';charset=utf8', self::USER, self::PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Retour d'erreur à enlever en prod !!
			$bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);   // Evite de ne renvoyer que des Strings en tableau associatif
		}
		catch(Exception $exception) {
			die("Erreur lors de la connexion à la BDD : {$exception->getMessage()}");
		}
		// Retourne l'objet PDO
		return $bdd;
	}
}
