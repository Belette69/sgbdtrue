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
      <a href="index.php" class="btn btn-primary">Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=home&entities=secretariat" class="btn btn-primary">Back</a>
    </div>
  </div>
</div>
<form action="" method="post" class="user-form">
    <p>
        <label for="nom">Nom </label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" class="form-control" name="nom" id="nom" value="<?php echo htmlentities($secretariat->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="prenom">Prénom </label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="prenom" class="form-control" id="prenom" value="<?php echo htmlentities($secretariat->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email </label><input <?php echo isset($invalidFields) && in_array('email', $invalidFields) ? 'class="error"' : ""?>  type="email" required="required" name="email" class="form-control" id="email" value="<?php echo htmlentities($secretariat->getEmail(), ENT_QUOTES);?>" placeholder="exemple@exemple.com"/>
    </p>
    <p>
        <label for="numero">Numero </label><input <?php echo isset($invalidFields) && in_array('numero', $invalidFields) ? 'class="error"' : ""?>  type="numero" required="required" name="numero" class="form-control" id="numero" value="<?php echo htmlentities($secretariat->getNumero(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="pseudo">Pseudo </label><input <?php echo isset($invalidFields) && in_array('pseudo', $invalidFields) ? 'class="error"' : ""?>  type="pseudo" required="required" name="pseudo" class="form-control" id="pseudo" value="<?php echo htmlentities($secretariat->getPseudo(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="password">Password </label><input <?php echo isset($invalidFields) && in_array('password', $invalidFields) ? 'class="error"' : ""?>  type="password" required="required" name="password" id="password" value="<?php echo htmlentities($secretariat->getPassword(), ENT_QUOTES);?>" type="password" class="form-control" placeholder="Password"/>
    </p>


        </select>
    </p>
    <p class="submit-container"><input type="submit" value="VALIDER"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($secretariat->getId()); ?>"/>
</form>