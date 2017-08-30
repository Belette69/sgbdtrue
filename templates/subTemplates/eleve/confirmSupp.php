<h1>Confirmation de la suppression d'un élève</h1>

<form action="" method="post" class="user-form">
    <p>Voulez-vous vraiment supprimer l'élève ? <?php echo htmlentities($eleve->getNom().' '.$eleve->getPrenom());?></p>
    <p><input type="hidden" name="confirmed" value="YES"/></p>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="OK"/></p>
</form>