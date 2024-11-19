<?php 
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php";
adminOnly();


require_once __DIR__ . "/templates/header.php"; 
?>

<div class="px-4 py-5 my-5 text-left">
  <h1 class="display-5 fw-bold text-body-emphasis">Page d'administration des horaires</h1>
  <div class="col-lg-12">
    <p class="lead mb-4">Backoffice du site Zoo Arcadia pour administrer les animaux, leur habitat et les services.</p>
  </div>
</div>

<?php require_once('templates/footer.php'); ?>