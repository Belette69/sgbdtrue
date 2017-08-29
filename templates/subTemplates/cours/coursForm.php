<div class="container-fluid">
<div class="row">
<div class="col">
      <a href="index.php" class="btn btn-primary">Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=home&entities=cours" class="btn btn-primary">Back</a>
    </div>
  </div>
</div>
<form action="index.php?action=create&amp;entities=cours" method="post" class="user-form">
    <p>
        <label for="intitule">Intitule</label><input <?php echo isset($invalidFields) && in_array('intitule', $invalidFields) ? 'class="error"' : ""?> type="text" class="form-control" required="required" name="intitule" id="intitule" value="<?php echo htmlentities($cours->getIntitule(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="periode">Nombre de périodes</label><input <?php echo isset($invalidFields) && in_array('periode', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" class="form-control" name="periode" id="periode" value="<?php echo htmlentities($cours->getPeriode(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="annee_scolaire">Année scolaire</label><input <?php echo isset($invalidFields) && in_array('annee_scolaire', $invalidFields) ? 'class="error"' : ""?>  type="annee_scolaire" required="required" class="form-control" name="annee_scolaire" id="annee_scolaire" value="<?php echo htmlentities($cours->getAnneeScolaire(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="id_prof">Professeur</label>
        <select <?php echo (isset($invalidFields) && in_array('id_prof', $invalidFields)) ? 'class="error"' : ""?>
        required="required" name="id_prof" id="id_prof" class="form-control">
        <?php foreach($profs as $prof): ?>
        <option value="<?php echo $prof->getId(); ?>" <?php if($cours->getProf()!=null && $cours->getProf()->getId()==$prof->getId()){echo 'selected';}?>><?php echo $prof->getPrenom().' '.$prof->getNom(); ?></option>
        <?php endforeach; ?>
        </select>    
    </p>

    </p>
    <p class="submit-container"><input type="submit" value="VALIDER"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($cours->getId()); ?>"/>
</form>