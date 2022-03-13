<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
$advertManager = new AdvertManager();
$adverts = $advertManager->listParts();
?>

<?php include_once('partials/header.php') ?>

<div class="jumbotron">
    <h1 class="display-5 text-primary">Le Bon Appart</h1>
    <p class="lead">Vendez, achetez, louez un appartement facilement avec Le Bon Appart !</p>
    <hr class="my-2">
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, impedit suscipit sapiente quod dolor tempora sit quas laboriosam sunt, temporibus soluta autem deserunt corporis qui et illo exercitationem voluptas beatae.
    </p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="add.php" role="button">J'ajoute mon annonce !</a>
        <a class="btn btn-success btn-lg" href="list.php" role="button">Voir la liste des annonces</a>
    </p>
</div>

<h1>Nos 15 dernières annonces ajoutées</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Annonce</th>
            <th>Lieu</th>
            <th>Prix et Catégorie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($adverts as $advert) : ?>
            <tr>
                <td>
                    <strong><?= mb_strtoupper($advert['title']) ?></strong>
                    <p>
                        <small>
                            <?= mb_strimwidth($advert['description'], 0, 50, " ...") ?>
                        </small>
                    </p>
                </td>
                <td>
                    <?= $advert['postcode'] ?> <?= mb_strtoupper($advert['city']) ?>
                </td>
                <td>
                    <span class="badge badge-primary"><?= $advert['category'] ?></span>
                    <span class="badge badge-secondary"><?= number_format($advert['price'], 0, " ", " ")." €" ?></span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include_once('partials/footer.php') ?>