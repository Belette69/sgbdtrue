<?php
use \sgbdtrue\entities\classroom\Gender;
use \sgbdtrue\entities\classroom\User;
/**
 * @var \sgbdtrue\entities\User $user
 */
if(!isset($user) || !($user instanceof User))
    $user = new User();;
?>
<form action="./" method="post" class="user-form">
    <p>
        <label for="local">Numéro du local</label><input <?php echo isset($invalidFields) && in_array('local', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="local" id="local" value="<?php echo htmlentities($user->getlocal(), ENT_QUOTES);?>"/>
    </p>
 
    <p class="submit-container"><input type="submit" value="OK"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($user->getId()); ?>"/>
</form>