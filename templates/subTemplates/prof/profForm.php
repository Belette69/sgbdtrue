<?php

?>
<div class="container-fluid">
<div class="row">
<div class="col">
      <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=home&entities=prof" class="btn btn-dark"><span class="glyphicon glyphicon-backward"></span> Back</a>
    </div>
  </div>
</div>
<form action="" method="post" class="user-form">
    <p>
        <label for="prenom">Prénom</label><input type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'alert alert-danger' : ""?>" name="prenom" id="prenom" value="<?php echo htmlentities($prof->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="nom">Nom</label><input type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'alert alert-danger' : ""?>" name="nom" id="nom" value="<?php echo htmlentities($prof->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input type="email" required="required" class="form-control <?php echo (isset($invalidFields) && in_array('email', $invalidFields)) ? 'alert alert-danger' : ""?>" placeholder="exemple@exemple.com" name="email" id="email" value="<?php echo htmlentities($prof->getEmail(), ENT_QUOTES);?>"/>
    </p>


    <p class="submit-container"><input type="submit" class="btn btn-dark" value="Valider"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($prof->getId()); ?>"/>
</form>