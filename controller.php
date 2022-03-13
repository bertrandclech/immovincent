<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
// Instancie un manager pour les annonces
$advertManager = new AdvertManager();

// Ajouter une annonce à la BDD et vérifie que l'on vient bien d'un formulaire
if ( ($_GET['action']=='add') && !empty($_POST) ) {
    $addAction = $advertManager->add(new Advert([  'title' => $_POST['title'],
                                                   'description' => $_POST['description'],
                                                   'postcode' => $_POST['postcode'],
                                                   'city' => $_POST['city'],
                                                   'price' => $_POST['price'],
                                                   'category_id' => $_POST['category'] ]));
    $addAction ? header("Location: show.php?id={$addAction}") : header('Location: add.php');
}

// Modifie une annonce dans la BDD et vérifie que l'on vient bien d'un formulaire
if ( ($_GET['action']=='update') && !empty($_POST) ) {
    $advertManager->update(new Advert([ 'id_advert' => $_POST['id_advert'],
                                        'title' => $_POST['title'],
                                        'description' => $_POST['description'],
                                        'postcode' => $_POST['postcode'],
                                        'city' => $_POST['city'],
                                        'price' => $_POST['price'],
                                        'category_id' => $_POST['category'] ]))
    ? header("Location: show.php?id=" . $_POST['id_advert']) : header("Location: update.php?id=" . $_POST['id_advert']);
}

// Supprime une annonce dans la BDD
if ( ($_GET['action']=='delete')  ) {
    $advertManager->delete($advertManager->getAdvert($_GET['id'])) 
    ? header('Location: list.php') 
    : header("Location: show.php?id=" . $_GET['id']);
}

// Enregistre le message de réservation dans l'annonce en BDD
if ( ($_GET['action']=='booked') && !empty($_POST) ) {
    $advert = $advertManager->getAdvert($_GET['id']);
    $advertManager->book($advert->setReservation_message($_POST['reservation_message']));
    header("Location: show.php?id=" . $_GET['id']);
    exit();
}    

header('Location: index.php');
