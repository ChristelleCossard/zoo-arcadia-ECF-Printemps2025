<?php
    $imagePath = getServiceImage($service["photoservice"]);
?>

<div class="col-md-4 my-2">
    <div class="card">
        <img src="<?=$imagePath ?>" class="card-img-top" alt="<?=htmlentities($service["nameservice"]) ?>">
        <div class="card-body">
            <h5 class="card-title"><?= htmlentities($service["nameservice"]) ?></h5>
            <p class="card-text"><?=htmlentities(substr($service["description"], 0, 100)) ?></p>
            <a href="service.php?id=<?=$service["id"]?>" class="btn btn-primary">Lire la suite</a>
        </div>
    </div>
</div>