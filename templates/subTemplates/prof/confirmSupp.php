<h1>Confirmation de la suppression d'un professeur</h1>

<form action="" method="post" class="user-form">
    <p>Are you sure to want remove the prof : <?php echo htmlentities($prof->getPrenom().' '.$prof->getNom());?></p>
    <p><input type="hidden" name="confirmed" value="YES"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>