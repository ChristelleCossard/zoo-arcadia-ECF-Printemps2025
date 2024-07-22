<?php 
//require_once __DIR__ . "/lib/menu.php"; 
require_once __DIR__."/lib/config.php";
require_once __DIR__."/lib/pdo.php";
require_once __DIR__ . "/templates/header.php"; 
require_once('lib/service.php');


$services = getServices($pdo);

?>



<h1 align="center">Bienvenue sur la page des services!</h1>
<p></p>
<div class="row">
   <p> Ici les services</p>
</div>



<div class="row">

  <?php foreach ($services as $key => $service) { 
     include('templates/service_part.php');
  } ?>

</div>



<?php require_once __DIR__ . "/templates/footer.php"; ?>