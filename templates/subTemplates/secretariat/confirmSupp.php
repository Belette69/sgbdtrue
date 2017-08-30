<h1>Confirmation de la suppression d'un secrétaire</h1>
<?php
/**
 *
 *  @var \sgbdtrue\entities\Secretariat $secretariat
 */
?>
<form action="" method="post" class="user-form">
    <p>Voulez vous vraiment supprimer ce secrétaire ? <?php echo htmlentities($secretariat->getNom().' '.$secretariat->getPrenom());?></p>
    <p><input type="hidden" name="confirmed" value="YES"/></p>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="OK"/></p>
</form>