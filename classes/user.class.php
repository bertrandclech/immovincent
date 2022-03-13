<?php

/**
 * Entity USER
 */
class User {


/*  PROPRIÉTÉS */

   /**
    * @var int
    */
   private $id_user;

   /**
    * @var string
    */
   private $mail;

   /**
    * @var string
    */
   private $password;

   /**
    * @var boolean
    */
   private $admin;

   /**
    * @var string
    */
   private $created_at;

   /**
    * @var string
    */
   private $updated_at;


/*  CONSTRUCTEUR DE LA CLASSE */

    public function __construct(array $data) {
       foreach ($data as $key => $value) {
          // On récupère le nom du setter correspondant à l'attribut
          $method = 'set'.ucfirst($key);
          // Si le setter correspondant existe on l'appelle
          if (method_exists($this, $method)) { $this->$method($value); }
      }
    }   


/*  GETTERS */

   /**
    * @return int
    */
   public function getId_user() { return $this->id_user; }

   /**
    * @return string
    */
   public function getMail() { return $this->mail; }

   /**
    * @return string
    */
   public function getPassword() { return $this->password; }

   /**
    * @return boolean
    */
   public function getAdmin() { return $this->admin; }

   /**
    * @return string
    */
   public function getCreated_at() { return $this->created_at; }

   /**
    * @return string
    */
   public function getUpdated_at() { return $this->updated_at; }   

/*  SETTERS */        

   /**
    * @param int $id_user
    */
   private function setId_user(int $id_user) { 
      $this->id_user = $id_user; 
   }

   /**
    * @param string mail
    */
   private function setMail(string $mail) { 
      $this->id_mail = $mail; 
   }

   /**
    * @param string password
    */
   private function setPassword(string $password) { 
      $this->password = $password; 
   }   

   /**
    * [can be NULL]
    * @param boolean admin
    */
   private function setAdmin(?boolean $admin) { 
      $this->admin = $admin; 
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