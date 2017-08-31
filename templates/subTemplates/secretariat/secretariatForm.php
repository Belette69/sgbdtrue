<?php
use \sgbdtrue\entities\secretariat\Secretariat;
/**
 * @var \sgbdtrue\entities\Secretariat $secretariat
 */
if(!isset($secretariat) || !($secretariat instanceof Secretariat))
    $secretariat = new Secretariat();;
?>
<div class="container-fluid">
<div class="row">
<div class="col">
      <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=home&entities=secretariat" class="btn btn-dark"><span class="glyphicon glyphicon-backward"></span> Back</a>
    </div>
  </div>
</div>
<form action="" method="post" class="user-form">
    <p>
        <label for="nom">Nom </label><input type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'alert alert-danger' : ""?>" name="nom" id="nom" value="<?php echo htmlentities($secretariat->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="prenom">Prénom </label><input type="text" required="required" name="prenom" class="form-control <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'alert alert-danger' : ""?>" id="prenom" value="<?php echo htmlentities($secretariat->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email </label><input type="email" required="required" name="email" class="form-control <?php echo isset($invalidFields) && in_array('email', $invalidFields) ? 'alert alert-danger' : ""?>" id="email" value="<?php echo htmlentities($secretariat->getEmail(), ENT_QUOTES);?>" placeholder="exemple@exemple.com"/>
    </p>
    <p>
        <label for="numero">Numero </label><input type="numero" required="required" name="numero" class="form-control <?php echo isset($invalidFields) && in_array('numero', $invalidFields) ? 'alert alert-danger' : ""?>" id="numero" value="<?php echo htmlentities($secretariat->getNumero(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="pseudo">Pseudo </label><input type="pseudo" required="required" name="pseudo" class="form-control <?php echo isset($invalidFields) && in_array('pseudo', $invalidFields) ? 'alert alert-danger' : ""?>" id="pseudo" value="<?php echo htmlentities($secretariat->getPseudo(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="password">Password </label><input type="password" required="required" name="password" id="password" value="<?php echo htmlentities($secretariat->getPassword(), ENT_QUOTES);?>" type="password" class="form-control <?php echo isset($invalidFields) && in_array('password', $invalidFields) ? 'alert alert-danger' : ""?>" placeholder="Password"/>
    </p>


        </select>
    </p>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="VALIDER"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($secretariat->getId()); ?>"/>
</form>