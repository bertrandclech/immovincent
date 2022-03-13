<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});
$advertManager = new AdvertManager();
$adverts = $advertManager->list();
?>

<?php include_once('partials/header.php') ?>


<h1>Consultez toutes nos annonces</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Annonce</th>
            <th>Lieu</th>
            <th>Prix et Catégorie</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($adverts as $advert) : ?>
            <tr>
                <td>
                    <strong><?= strtoupper($advert['title']) ?></strong>
                    <p>
                        <small>
                            <?= mb_strimwidth($advert['description'], 0, 50, " ...") ?>
                        </small>
                    </p>
                </td>
                <td>
                    <?= $advert['postcode'] ?> <?= mb_strtoupper($advert['city']) ?>
                    <?php if(!empty($advert['reservation_message'])) :?>
                        <span class="badge badge-success">Ce bien a déjà été réservé !</span>
                    <?php endif;?>
                </td>
                <td>
                    <span class="badge badge-primary"><?= $advert['category'] ?></span>
                    <span class="badge badge-secondary"><?= number_format($advert['price'], 0, " ", " ")." €" ?></span>
                </td>
                <td>
                    <a href="show.php?id=<?= $advert['id_advert'] ?>" class="btn btn-success">Voir l'annonce</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php include_once('partials/footer.php') ?>