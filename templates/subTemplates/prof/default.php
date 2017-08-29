<h2>Gestion des professeurs</h2>
<?php
?>
<div class="container-fluid">
<div class="row">
    <div class="col">
      <a href="index.php" class="btn btn-dark">Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=create&amp;entities=prof" class="btn btn-dark">Ajouter un nouveau professeur</a>
    </div>
  </div>
</div>


<?php
include __DIR__.DIRECTORY_SEPARATOR.'profList.php';
