<h2>Gestion des élèves</h2>
<?php
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
      <a href="index.php" class="btn btn-primary">Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=create&amp;entities=eleve" class="btn btn-primary">Ajouter un nouvel élève</a>
    </div>
  </div>
</div>


<?php
include __DIR__.DIRECTORY_SEPARATOR.'eleveList.php';
