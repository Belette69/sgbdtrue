<?php

use \sgbdtrue\entities\secretariat\User;
/**
 * @var \sgbdtrue\entities\User $user
 */
if(!isset($user) || !($user instanceof User))
    $user = new User();;
?>
<form action="./" method="post" class="user-form">
    <p>
        <label for="prenom">First name</label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="prenom" id="prenom" value="<?php echo htmlentities($user->getprenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="nom">Last name</label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="nom" id="nom" value="<?php echo htmlentities($user->getnom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo (isset($invalidFields) && in_array('email', $invalidFields)) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($user->getEmail(), ENT_QUOTES);?>"/>
    </p>
    
        </select>
    </p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($user->getId()); ?>"/>
</form>