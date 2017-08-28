<?php
use \sgbdtrue\entities\eleve\Eleve;
/**
 * @var \sgbdtrue\entities\Eleve $eleve
 */
if(!isset($eleve) || !($eleve instanceof Eleve))
    $eleve = new Eleve();;
?>
<form action="" method="post" class="eleve-form">
    <p>
        <label for="nom">Nom</label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="nom" id="nom" value="<?php echo htmlentities($eleve->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="prenom">Prénom</label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="prenom" id="prenom" value="<?php echo htmlentities($eleve->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo isset($invalidFields) && in_array('email', $invalidFields) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($eleve->getEmail(), ENT_QUOTES);?>"/>
    </p>


        </select>
    </p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($eleve->getId()); ?>"/>
</form>