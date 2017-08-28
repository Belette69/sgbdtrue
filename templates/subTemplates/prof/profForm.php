<?php
use \sgbdtrue\entities\prof\Prof;
/**
 * @var \sgbdtrue\entities\Prof $prof
 */
if(!isset($prof) || !($prof instanceof Prof))
    $prof = new Prof();;
?>
<form action="" method="post" class="user-form">
    <p>
        <label for="prenom">Prénom</label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="prenom" id="prenom" value="<?php echo htmlentities($prof->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="nom">Nom</label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="nom" id="nom" value="<?php echo htmlentities($prof->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo (isset($invalidFields) && in_array('email', $invalidFields)) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($prof->getEmail(), ENT_QUOTES);?>"/>
    </p>


    <p class="submit-container"><input type="submit" value="OK"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($prof->getId()); ?>"/>
</form>