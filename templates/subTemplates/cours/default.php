<h2>Gestion des cours</h2>
<?php
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
      <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=create&amp;entities=cours" class="btn btn-dark"><span class="glyphicon glyphicon-plus"></span> Ajouter un nouveau cours</a>
    </div>
  </div>
</div>


<?php
include __DIR__.DIRECTORY_SEPARATOR.'coursList.php';
