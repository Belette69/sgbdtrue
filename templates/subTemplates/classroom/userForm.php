<?php
use \sgbdtrue\entities\user\Gender;
use \sgbdtrue\entities\user\User;
/**
 * @var \sgbdtrue\entities\User $user
 */
if(!isset($user) || !($user instanceof User))
    $user = new User();;
?>
<form action="./" method="post" class="user-form">
    <p>
        <label for="firstName">First name</label><input <?php echo isset($invalidFields) && in_array('firstName', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="firstName" id="firstName" value="<?php echo htmlentities($user->getFirstName(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="lastName">Last name</label><input <?php echo isset($invalidFields) && in_array('lastName', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="lastName" id="lastName" value="<?php echo htmlentities($user->getLastName(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo (isset($invalidFields) && in_array('email', $invalidFields)) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($user->getEmail(), ENT_QUOTES);?>"/>
    </p>
    <p><label for="gender">Gender</label>
        <select name="gender" id="gender">
            <?php
            $availableOptions = [Gender::M => "M", Gender::F => "F"];
            foreach($availableOptions as $gender => $label):
                $isSelect = $user->getGender() == $gender;
                ?>
                <option value="<?php echo $gender?>" <?php echo $isSelect?'selected="selected"' : '' ?>><?php echo $label ?></option>
            <?php
            endforeach;
            ?>

        </select>
    </p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($user->getId()); ?>"/>
</form>