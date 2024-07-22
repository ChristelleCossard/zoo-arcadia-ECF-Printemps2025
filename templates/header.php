<?php
  require_once('lib/session.php');
  require_once('lib/config.php');
 require_once ('lib/pdo.php');

  $currentPage = basename($_SERVER['SCRIPT_NAME']);
//var_dump($_SERVER);
  
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alkatra&display=swap" rel="stylesheet">
  
    
    <title>Zoo Arcadia</title>
</head>

<body>

    <div class="container">
    <div class="bg-success p-2" style="--bs-bg-opacity: .2;">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">

            <a href="./index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="100" src="assets/images/logo-zoo.png" alt="Logo Zoo Arcadia">
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 nav nav-pills">
        <?php foreach ($mainMenu as $key => $value) { ?>
          <li class="nav-item"><a href="<?=$key; ?>" class="nav-link <?php if ($currentPage === $key) { echo 'active'; } ?>"><?=$value ;?></a></li>
        <?php } ?>
        </ul>
        
        <div class="col-md-3 text-end">
      <?php if(!isset($_SESSION['user'])) { ?>
        <a href="login.php" class="btn btn-outline-primary me-2">Se connecter</a>
        <a href="inscription.php" class="btn btn-outline-primary me-2">S'inscrire</a>
        <?php } else { ?>
          <a href="administration.php" class="btn btn-primary">Administration</a>
          <a href="logout.php" class="btn btn-primary">Se déconnecter</a>
        <?php } ?>
        
      </div>

              
        </header>
        </div>
        <main>