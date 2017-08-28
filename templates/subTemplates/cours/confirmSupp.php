<h1>Confirmation de la suppression d'un utilisateur</h1>
<?php
/**
 *
 *  @var \sgbdtrue\entities\User $user
 */
?>
<form action="" method="post" class="user-form">
    <p>Are you sure to want remove the user : <?php echo htmlentities($user->getNom().' '.$user->getPrenom());?></p>
    <p><input type="hidden" name="confirmed" value="YES"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>