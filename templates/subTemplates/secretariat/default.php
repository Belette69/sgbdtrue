<h2>Gestion du secrétariat</h2>
<div class="container-fluid">
<div class="row">
    <div class="col">
      <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=create&amp;entities=secretariat" class="btn btn-dark"><span class="glyphicon glyphicon-plus"></span> Ajouter un nouveau secrétaire</a>
    </div>
  </div>
</div>




<?php
include __DIR__.DIRECTORY_SEPARATOR.'secretariatList.php';
