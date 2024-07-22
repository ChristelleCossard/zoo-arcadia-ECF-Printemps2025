<?php 


require_once __DIR__ . "/lib/config.php"; 
require_once __DIR__ . "/lib/pdo.php"; 
//require_once __DIR__ . "/lib/article.php"; 
require_once __DIR__ . "/lib/service.php";
require_once __DIR__ . "/lib/menu.php"; 

//$mainMenu["actualite.php"] = ["head_title" => "Article introuvable", "meta_description" => "Article introuvable", "exclude" => true];

$error = false;

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $service = getServiceById($pdo, $id);
    
    if ($service) {
        $imagePath = getServiceImage($service["image"]);
        $mainMenu["service.php"] = ["head_title" => htmlentities($service["nameservice"]), "meta_description" => htmlentities(substr($service["description"], 0, 250)), "exclude" => true];
    } else {
        $error = true;
    }    
} else {
    $error = true;
}





require_once __DIR__ . "/templates/header.php"; 

?>

<?php if (!$error) { ?>
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?=$imagePath ?>" class="d-block mx-lg-auto img-fluid" alt="<?=htmlentities($service["nameservice"]) ?>" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=htmlentities($service["nameservice"]) ?></h1>
            <p class="lead"><?=htmlentities($service["description"]) ?></p>
        </div>
    </div>
<?php } else { ?>
    <h1>Service introuvable</h1>
<?php } ?>




<?php require_once __DIR__ . "/templates/footer.php"; ?>