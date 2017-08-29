<h1>Confirmation de la suppression d'un utilisateur</h1>

<form action="" method="post" class="user-form">
    <p>Voulez-vous vraiment supprimer le cours : <?php echo htmlentities($cours->getIntitule());?></p>
    <p><input type="hidden" name="confirmed" value="YES"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>