<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
// Instancie un manager pour les annonces
$advertManager = new AdvertManager();

// Méthode pour récupérer les différentes catégories
$categories = $advertManager->getCategory();

// On récupère l'annonce par son ID
$advert = $advertManager->getById($_GET['id']);
?>

<?php include_once('partials/header.php') ?>

<h1>Modifier le contenu de cette annonce</h1>
<a href="list.php">Retour à la liste des biens</a>

<form action="controller.php?action=update" method="post">

<!--     ID de l'annonce à modifier en champ cach -->
    <input name="id_advert" type="hidden" value="<?= $advert['id_advert'] ?>">

    <div class="form-group">
        <label for="">Titre *</label>
        <input name="title" type="text" class="form-control" value="<?= $advert['title'] ?>" required>
    </div>

    <div class="form-group">
        <label for="">Description *</label>
        <textarea name="description" id="" cols="30" rows="5" class="form-control" required><?= $advert['description'] ?></textarea>
    </div>

    <div class="form-group">
        <label for="">Code postal *</label>
        <input name="postcode" type="text" class="form-control" value="<?= $advert['postcode'] ?>" required>
    </div>

    <div class="form-group">
        <label for="">Ville *</label>
        <input name="city" type="text" class="form-control" value="<?= $advert['city'] ?>" required>
    </div>

    <div class="form-group">
        <label for="">Tarif *</label>
        <div class="input-group">
            <input name="price" type="number" class="form-control" value="<?=$advert['price'] ?>" required>
            <div class="input-group-append">
                <div class="input-group-text">€</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="">Catégorie *</label>
        <select name="category" id="" class="form-control" required>
            <?php foreach ($categories as $categorie): ?>
                <?php if ($categorie['id_category']==$advert['category_id']): ?>
                    <option value="<?= $categorie['id_category']; ?>" selected><?= $categorie['value']; ?></option>
                <?php else: ?>
                    <option value='<?= $categorie['id_category']; ?>' ><?= $categorie['value']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>      
        </select>
    </div>

    <button class="btn btn-primary float-right">Valider les modifications</button>

</form>


<?php include_once('partials/footer.php') ?>
