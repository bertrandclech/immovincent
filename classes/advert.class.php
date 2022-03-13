<?php

/**
 * Entity ADVERT
 */
class Advert {

/*	PROPRIÉTÉS */

	/**
	 * @var int
	 */
	private $id_advert;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var string
	 */
	private $postcode;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var int
	 */
	private $price;

	/**
	 * @var string
	 */
	private $reservation_message;

	/**
	 * @var string
	 */
	private $picture;

	/**
	 * @var int
	 */
	private $category_id;

	/**
	 * @var int
	 */
	private $user_id;

	/**
	 * @var int
	 */
	private $reservation_id;

	/**
	 * @var string
	 */
	private $created_at;

	/**
	 * @var string
	 */
	private $updated_at;


/*	CONSTRUCTEUR DE LA CLASSE */

	public function __construct(array $data) {
       foreach ($data as $key => $value) {
          // On récupère le nom du setter correspondant à l'attribut
          $method = 'set'.ucfirst($key);
          // Si le setter correspondant existe on l'appelle
          if (method_exists($this, $method)) { $this->$method($value); }
      }
    }	

/*	GETTERS */

   /**
    * @return int
    */
	public function getId_advert() { return $this->id_advert; }

	/**
	 * @return string
	 */
	public function getTitle() { return $this->title; }

	/**
	 * @return string
	 */
	public function getDescription() { return $this->description; }

	/**
	 * @return string
	 */
	public function getPostcode() { return $this->postcode; }

	/**
	 * @return string
	 */
	public function getCity() { return $this->city; }

	/**
	 * @return int
	 */
	public function getPrice() { return $this->price; }

	/**
	 * @return string
	 */
	public function getReservation_message() { return $this->reservation_message; }

	/**
	 * @return string
	 */
	public function getPicture() { return $this->picture; }

	/**
	 * @return int
	 */
	public function getCategory_id() { return $this->category_id; }

	/**
	 * @return int
	 */
	public function getUser_id() { return $this->user_id; }

	/**
	 * @return int
	 */
	public function getReservation_id() { return $this->reservation_id; }

	/**
	 * @return string
	 */
	public function getCreated_at() { return $this->created_at; }

	/**
	 * @return string
	 */
	public function getUpdated_at() { return $this->updated_at; }

/*	SETTERS */

	/**
	 * @param int $id_advert
	 */
	private function setId_advert(int $id_advert) { 
		$this->id_advert = $id_advert; 
	}

	/**
	 * @param string $title
	 */
	private function setTitle(string $title) { 
		$this->title = $title; 
	}

	/**
	 * @param string $description
	 */
	private function setDescription(string $description) { 
		$this->description = $description; 
	}	

	/**
	 * @param string $postcode
	 */
	private function setPostcode(string $postcode) { 
		$this->postcode = $postcode; 
	}

	/**
	 * @param string $city
	 */
	private function setCity(string $city) { 
		$this->city = $city; 
	}	

	/**
	 * @param int $price
	 */
	private function setPrice(int $price) { 
		$this->price = $price; 
	}	

	/**
	 * [can be NULL]
	 * @param string $reservation_message
	 */
	public function setReservation_message(?string $reservation_message) { 
		$this->reservation_message = $reservation_message; 
		return $this; 
	}

	/**
	 * @param string $picture
	 */
	private function setPicture(string $picture) { 
		$this->picture = $picture; 
	}	

	/**
	 * @param int $category_id
	 */
	private function setCategory_id(int $category_id) { 
		$this->category_id = $category_id; 
	}	

	/**
	 * @param int $user_id
	 */
	private function setUser_id(int $user_id) { 
		$this->user_id = $user_id; 
	}	

	/**
	 * @param int $reservation_id
	 */
	private function setReservation_id(int $reservation_id) { 
		$this->reservation_id = $reservation_id; 
	}	

	/**
	 * @param string $created_at
	 */
	private function setCreated_at(string $created_at) { 
		$this->created_at = $created_at; 
	}	

	/**
	 * [can be NULL]
	 * @param string $updated_at
	 */
	private function setUpdated_at(?string $updated_at) { 
		$this->updated_at = $updated_at; 
	}	

}	