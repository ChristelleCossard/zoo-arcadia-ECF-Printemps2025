<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();

require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/tools.php";
//require_once __DIR__ . "/../lib/article.php";
//require_once __DIR__ . "/../lib/car.php";
require_once __DIR__ . "/../lib/service.php";
//require_once __DIR__ . "/../lib/category.php";
require_once __DIR__ . "/templates/header.php";


$errors = [];
$messages = [];
$service = [
    'title' => '',
    'description' => '',
    'category_id' => ''
];

//$categories = getCategories($pdo);

if (isset($_GET['id'])) {
    //requête pour récupérer les données de l'article en cas de modification
    $service = getServiceById($pdo, $_GET['id']);
    if ($service === false) {
        $errors[] = "Le vehicule n\'existe pas";
    }
    $pageTitle = "Formulaire modification voiture";
} else {
    $pageTitle = "Formulaire d'ajout d'un service";
}

if (isset($_POST['saveService'])) {

    //@todo gérer la gestion des erreurs sur les champs (champ vide etc.)
    
    $fileName = null;
    // Si un fichier est envoyé
    if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != '') {
        $checkImage = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkImage !== false) {
            $fileName = slugify(basename($_FILES["file"]["name"]));
            $fileName = uniqid() . '-' . $fileName;



            /* On déplace le fichier uploadé dans notre dossier upload, dirname(__DIR__) 
                permet de cibler le dossier parent car on se trouve dans admin
            */
            if (move_uploaded_file($_FILES["file"]["tmp_name"], dirname(__DIR__)._ARTICLES_IMAGES_FOLDER_ . $fileName)) {
                if (isset($_POST['image'])) {
                    // On supprime l'ancienne image si on a posté une nouvelle
                    unlink(dirname(__DIR__)._ARTICLES_IMAGES_FOLDER_ . $_POST['image']);
                }
            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }
        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    } else {
        // Si aucun fichier n'a été envoyé
        if (isset($_GET['id'])) {
            if (isset($_POST['delete_image'])) {
                // Si on a coché la case de suppression d'image, on supprime l'image
                unlink(dirname(__DIR__)._ARTICLES_IMAGES_FOLDER_ . $_POST['image']);
            } else {
                $fileName = $_POST['image'];
            }
        }
    }
    /* On stocke toutes les données envoyés dans un tableau pour pouvoir afficher
       les informations dans les champs. C'est utile pas exemple si on upload un mauvais
       fichier et qu'on ne souhaite pas perdre les données qu'on avait saisit.
    */
    $service = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        //'category_id' => $_POST['category_id'],
        'image' => $fileName
    ];
    // Si il n'y a pas d'erreur on peut faire la sauvegarde
    if (!$errors) {
        if (isset($_GET["id"])) {
            // Avec (int) on s'assure que la valeur stockée sera de type int
            $id = (int)$_GET["id"];
        } else {
            $id = null;
        }
        // On passe toutes les données à la fonction saveArticle
        $res = saveService($pdo, $_POST["title"], $_POST["description"], $fileName, (int)$_POST["category_id"], $id);

        if ($res) {
            $messages[] = "Le véhicule a bien été sauvegardé";
            //On vide le tableau article pour avoir les champs de formulaire vides
            if (!isset($_GET["id"])) {
                $service = [
                    'title' => '',
                    'description' => '',
                    'category_id' => ''
                ];
            }
        } else {
            $errors[] = "La voiture n'a pas été sauvegardée";
        }
    }
}

?>
<h1><?= $pageTitle; ?></h1>

<?php foreach ($messages as $message) { ?>
    <div class="alert alert-success" role="alert">
        <?= $message; ?>
    </div>
<?php } ?>
<?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?>
    </div>
<?php } ?>
<?php if ($service !== false) { ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $service['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Contenu</label>
            <textarea class="form-control" id="description" name="description" rows="8"><?= $service['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <select name="category_id" id="category" class="form-select">
                <?php foreach ($categories as $category) { ?>
                    <option value="1" <?php if (isset($service['category_id']) && $service['category_id'] == $category['id']) { ?>selected="selected" <?php }; ?>><?= $category['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <?php if (isset($_GET['id']) && isset($service['image'])) { ?>
            <p>
                <img src="<?= _ARTICLES_IMAGES_FOLDER_ . $service['image'] ?>" alt="<?= $car['title'] ?>" width="100">
                <label for="delete_image">Supprimer l'image</label>
                <input type="checkbox" name="delete_image" id="delete_image">
                <input type="hidden" name="image" value="<?= $service['image']; ?>">

            </p>
        <?php } ?>
        <p>
            <input type="file" name="file" id="file">
        </p>

        <input type="submit" name="saveService" class="btn btn-primary" value="Enregistrer">

    </form>

<?php } ?>



<?php require_once __DIR__ . "/templates/footer.php"; ?>