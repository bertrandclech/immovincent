<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
// Instancie un manager pour les annonces
$advertManager = new AdvertManager();

// Méthode pour récupérer les différentes catégories
$categories = $advertManager->getCategory();
?>

<?php include_once('partials/header.php') ?>

<h1>Ajouter une annonce</h1>
<a href="index.php">Retour à l'accueil de notre site</a>

<form action="controller.php?action=add" method="post">

    <div class="form-group">
        <label for="">Titre *</label>
        <input name="title" type="text" class="form-control" placeholder="Un nom attrayant pour votre annonce..." required>
    </div>

    <div class="form-group">
        <label for="">Description *</label>
        <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Une description qui donne envie !" required></textarea>
    </div>

    <div class="form-group">
        <label for="">Code postal *</label>
        <input name="postcode" type="text" class="form-control" placeholder="69002" required>
    </div>

    <div class="form-group">
        <label for="">Ville *</label>
        <input name="city" type="text" class="form-control" placeholder="Lyon 2ème" required>
    </div>

    <div class="form-group">
        <label for="">Tarif *</label>
        <div class="input-group">
            <input name="price" type="number" class="form-control" placeholder="500" required>
            <div class="input-group-append">
                <div class="input-group-text">€</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="">Catégorie *</label>
        <select name="category" id="" class="form-control" required>
            <option selected disabled>Sélectionnez une catégorie</option>
            <?php foreach ($categories as $categorie): ?>
                <option value='<?= $categorie['id_category'] ?>' ><?= $categorie['value'] ?></option>
            <?php endforeach; ?>            
        </select>
    </div>

    <button class="btn btn-primary float-right">Créer une annonce</button>

</form>


<?php include_once('partials/footer.php') ?>
