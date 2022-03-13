<?php
require_once 'bdd.class.php';
/**
 * ADVERT Manager
 */
class AdvertManager extends BDD {

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
	 * [Save an Advert in Db]
	 * @param Advert $advert
	 */
	public function add(Advert $advert) {
		// Préparation de la requête
		$add_advert = $this->bdd->prepare('INSERT INTO advert(	advert.`title`,
																advert.`description`,
																advert.`postcode`,
																advert.`city`,
															  	advert.`price`,
															  	advert.`category_id`)
										   VALUES (:title, :description, :postcode, :city, :price, :category_id);');
		// On associe une valeur aux différents marqueurs de la requête
		$add_advert->bindValue(':title', $advert->getTitle(), PDO::PARAM_STR);
		$add_advert->bindValue(':description', $advert->getDescription(), PDO::PARAM_STR);
		$add_advert->bindValue(':postcode', $advert->getPostcode(), PDO::PARAM_STR);
		$add_advert->bindValue(':city', $advert->getCity(), PDO::PARAM_STR);
		$add_advert->bindValue(':price', $advert->getPrice(), PDO::PARAM_INT);
		$add_advert->bindValue(':category_id', $advert->getCategory_id(), PDO::PARAM_INT);
		// Exécution de la requête
		$add_advert->execute();
		// Retourne soit FALSE en cas d'erreur, soit le numéro de l'Id de l'annonce
        return $this->bdd->lastInsertId();
	}

	/**
	 * [Update an Advert in Db]
	 * @param Advert $advert
	 * @return boolean
	 */
	public function update(Advert $advert) {
		// Préparation de la requête
		$update_advert = $this->bdd->prepare(' UPDATE `advert` SET 	advert.`title` = :title,
																  	advert.`description` = :description,
																  	advert.`postcode` = :postcode,
																  	advert.`city` = :city,
																  	advert.`price` = :price,
																  	advert.`category_id` = :category_id,
																  	advert.`updated_at` = :updated_at
											   WHERE advert.`id_advert` = :id_advert;');
		// On associe une valeur aux différents marqueurs de la requête
		$update_advert->bindValue(':title', $advert->getTitle(), PDO::PARAM_STR);
		$update_advert->bindValue(':description', $advert->getDescription(), PDO::PARAM_STR);
		$update_advert->bindValue(':postcode', $advert->getPostcode(), PDO::PARAM_STR);
		$update_advert->bindValue(':city', $advert->getCity(), PDO::PARAM_STR);
		$update_advert->bindValue(':price', $advert->getPrice(), PDO::PARAM_INT);
		$update_advert->bindValue(':category_id', $advert->getCategory_id(), PDO::PARAM_INT);
		$update_advert->bindValue(':updated_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
		$update_advert->bindValue(':id_advert', $advert->getId_advert(), PDO::PARAM_INT);
		// Exécution de la requête
		$update_advert->execute();
		// Retourne soit FALSE en cas d'erreur, doit le nombre de lignes affectés par la requète
        return $update_advert->rowCount();
	}

	/**
	 * [Delete an advert in Db]
	 * @param Advert $advert
	 * @return boolean
	 */
	public function delete(Advert $advert) {
        $delete_advert = $this->bdd->prepare("DELETE FROM advert WHERE advert.`id_advert` = :id");
        $delete_advert->bindValue(':id', $advert->getId_advert(), PDO::PARAM_INT);
        $delete_advert->execute();
        $delete_advert->closeCursor();
        return ($delete_advert->rowCount());
	}

	/**
	 * [Get an advert by his Id]
	 * @param  int $id
	 * @return array
	 */
	public function getById($id) {
		$show_advert = $this->bdd->prepare(" SELECT advert.`id_advert`, 
													advert.`title`, 
													advert.`description`, 
													advert.`postcode`,
													advert.`city`, 
													advert.`price`, 
													advert.`created_at`,
													advert.`updated_at`, 
													advert.`reservation_message`, 
													advert.`category_id`,
													category.`value` AS category
            						   		FROM `advert`
                                       		INNER JOIN `category` ON advert.`category_id` = category.`id_category`
            						   		WHERE advert.`id_advert` = :id");
		$show_advert->execute(['id' => $id]);
		return $show_advert->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * [Get an Object advert by his Id]
	 * @param  int  $id
	 * @return  Advert
	 */
	public function getAdvert($id) {
		return new Advert($this->getById($id));
	}

	/**
	 * [Méthode qui retourne la liste des annonces présentes en BDD sous forme de tableau associatif]
	 * @return array
	 */
	public function list() {
        $list_adverts = $this->bdd->query('	SELECT 	advert.`id_advert`, 
        											advert.`title`, 
        											advert.`description`,
        										  	advert.`postcode`, 
        										  	advert.`city`, 
        										  	advert.`price`, 
        										  	advert.`reservation_message`, 
        										  	category.`value` AS category
            							   	FROM `advert`
            							   	INNER JOIN `category` ON advert.`category_id` = category.`id_category`;');
        return $list_adverts->fetchAll(PDO::FETCH_ASSOC);
	}	

	/**
	 * [Méthode qui retourne la liste des annonces présentes en BDD sous forme de tableau associatif dans l’ordre antéchronologique (la plus récente en premier) et seules les 15 dernières annonces]
	 * @return array
	 */
	public function listParts() {

        $listParts_adverts = $this->bdd->query('SELECT 	advert.`id_advert`, 
        												advert.`title`, 
        												advert.`description`,
        										  		advert.`postcode`, 
        										  		advert.`city`, 
        										  		advert.`price`,  
        										  		category.`value` AS category
            							   		FROM `advert`
            							   		INNER JOIN `category` ON advert.`category_id` = category.`id_category`  
            							   		ORDER BY `created_at` DESC LIMIT 0, 15;');
        return $listParts_adverts->fetchAll(PDO::FETCH_ASSOC);            
	}

	/**
	 * [Modifie l'annonce en ajoutant un message de réservation]
	 * @return boolean
	 */
	public function book(Advert $advert) {
		$book_advert = $this->bdd->prepare('UPDATE `advert` 
											SET advert.`reservation_message` = :reservation_message 
											WHERE advert.`id_advert` = :id_advert');
		$book_advert->bindValue(':reservation_message', $advert->getReservation_message(), PDO::PARAM_STR);
		$book_advert->bindValue(':id_advert', $advert->getId_advert(), PDO::PARAM_INT);
        $book_advert->execute();
        $book_advert->closeCursor();
        return ($book_advert->rowCount());
	}

	/**
	 * [Retourne les différentes Categories sous forme de tableau]
	 * @return array
	 */
	public function getCategory() {
		return $this->bdd->query("SELECT * FROM `category`")->fetchAll(PDO::FETCH_ASSOC);
	}

}