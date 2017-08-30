
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
        </div>
        <div class="col">
<<<<<<< HEAD
            <a href="index.php?action=home&amp;entities=eleve" class="btn btn-dark">Back</a>
||||||| merged common ancestors
            <a href="index.php?action=home&entities=eleve" class="btn btn-dark">Back</a>
=======
            <a href="index.php?action=home&entities=eleve" class="btn btn-dark"><span class="glyphicon glyphicon-backward"></span> Back</a>
>>>>>>> 4009cec2478a9df83fe74bf4b32302fbc224e8e3
        </div>
    </div>
</div>
<form action="" method="post" class="eleve-form">
    <p>
        
        <label for="nom">Nom</label><input type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'alert alert-danger' : ""?>" name="nom" id="nom" value="<?php echo htmlentities($eleve->getNom(), ENT_QUOTES);?>"/>
        
    </p>
    <p>
        <label for="prenom">Prénom</label><input type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'alert alert-danger' : ""?>" name="prenom" id="prenom" value="<?php echo htmlentities($eleve->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input type="email" required="required" class="form-control <?php echo isset($invalidFields) && in_array('email', $invalidFields) ? 'alert alert-danger' : ""?>" placeholder="exemple@exemple.com" name="email" id="email" value="<?php echo htmlentities($eleve->getEmail(), ENT_QUOTES);?>"/>
    </p>


        </select>
    </p>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="Valider"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($eleve->getId()); ?>"/>
</form>