<?php
// Auto-chargement des classes utilisées dans ce fichier
spl_autoload_register(function($classe){
    require 'classes/' .$classe. '.class.php';
});

// On récupère l'annonce par son ID
$advertManager = new AdvertManager();
$advert = $advertManager->getById($_GET['id']);

// Initialisation de l'objet de formatage de date
$fmt = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
?>

<?php include_once('partials/header.php') ?>


<h1 class="text-success"><?= $advert['title'] ?></h1>

<a href="list.php">Retour à la liste des biens</a>
<hr>
<div class="card">
    <div class="card-header">
        <?= $advert['title'] ?> située à <?= $advert['city'] ?> (code postal: <?= $advert['postcode'] ?>)
    </div>
    <div class="card-body">
        <small class="text-success">
            Ce bien est une <?= $advert['category'] ?> proposée à un tarif de <?= number_format($advert['price'], 0, " ", " ")." €" ?>.
        </small>
        <div><?= $advert['description'] ?></div>
    </div>
    <div class="card-footer">
        Cette annnonce a été mise en ligne le <span class="text-primary"><?= $fmt->format(date_create($advert['created_at'])) ?></span>
        <?php if ($advert['updated_at'] !== NULL) : ?>
            et modifiée le <span class="text-primary"><?= $fmt->format(date_create($advert['updated_at'])) ?></span>
        <?php endif; ?>            
    </div>
</div>

<div>
    <a class="btn btn-success" href="update.php?id=<?= $advert['id_advert'] ?>" role="button">Modifier votre annonce !</a>
    <a class="btn btn-primary" href="controller.php?action=delete&id=<?= $advert['id_advert'] ?>" role="button" onclick="return confirm('Confirmer l\'effacement de cette annonce !')">Supprimer votre annonce</a>
</div>

<hr>
<p>
    <?php if (!$advert['reservation_message']) : ?>
        <p>
            <strong>
                Ce bien n'est pas réservé ! Soyez les premiers à laisser un message afin que le propriétaire vous recontacte.
            </strong>

            <form action="controller.php?action=booked&id=<?= $advert['id_advert'] ?>" method="post">
                <div class="form-group">
                    <label for="formReservationMessage">Message de réservation</label>
                    <textarea name="reservation_message" id="formReservationMessage" rows="5" class="form-control" placeholder="Donnez un maximum de coordonnées pour que le propriétaire vous recontacte !"></textarea>
                </div>

                <button class="btn btn-primary float-right">Je réserve ce bien !</button>
            </form>
        </p>
    <?php else : ?>
        <div class="alert alert-success">
            <p>
                Ce bien a été reservé, voici le message du futur habitant :
                <hr>
                <em><?= $advert['reservation_message'] ?></em>
            </p>
        </div>
    <?php endif; ?>
</p>
<?php include_once('partials/footer.php') ?>
