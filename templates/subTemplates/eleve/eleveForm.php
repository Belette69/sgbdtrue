<style>

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="index.php" class="btn btn-dark">Home</a>
        </div>
        <div class="col">
            <a href="index.php?action=home&entities=eleve" class="btn btn-dark">Back</a>
        </div>
    </div>
</div>
<form action="" method="post" class="eleve-form">
    <p>
        
        <label for="nom">Nom</label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" class="form-control" name="nom" id="nom" value="<?php echo htmlentities($eleve->getNom(), ENT_QUOTES);?>"/>
        
    </p>
    <p>
        <label for="prenom">Prénom</label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" class="form-control" name="prenom" id="prenom" value="<?php echo htmlentities($eleve->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo isset($invalidFields) && in_array('email', $invalidFields) ? 'class="error"' : ""?>  type="email" required="required" class="form-control" placeholder="exemple@exemple.com" name="email" id="email" value="<?php echo htmlentities($eleve->getEmail(), ENT_QUOTES);?>"/>
    </p>


        </select>
    </p>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="VALIDER"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($eleve->getId()); ?>"/>
</form>