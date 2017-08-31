<div class="container-fluid">
<div class="row">
<div class="col">
      <a href="index.php" class="btn btn-dark"><span class="glyphicon glyphicon-home"></span> Home</a>
    </div>
    <div class="col">
    <a href="index.php?action=home&entities=cours" class="btn btn-dark"><span class="glyphicon glyphicon-backward"></span> Back</a>
    </div>
  </div>
</div>
<form action="index.php?action=create&amp;entities=cours" method="post" class="user-form">
    <p>
        <label for="intitule">Intitule</label><input class="form-control <?php echo isset($invalidFields) && in_array('intitule', $invalidFields) ? 'alert alert-danger' : ""?> " type="text" class="form-control" required="required" name="intitule" id="intitule" value="<?php echo htmlentities($cours->getIntitule(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="periode">Nombre de périodes</label><input   type="text" required="required" class="form-control <?php echo isset($invalidFields) && in_array('periode', $invalidFields) ? 'alert alert-danger' : ""?>" name="periode" id="periode" value="<?php echo htmlentities($cours->getPeriode(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="annee_scolaire">Année scolaire</label><input type="annee_scolaire" required="required" class="form-control <?php echo isset($invalidFields) && in_array('annee_scolaire', $invalidFields) ? 'alert alert-danger' : ""?>" name="annee_scolaire" id="annee_scolaire" value="<?php echo htmlentities($cours->getAnneeScolaire(), ENT_QUOTES);?>"/>
    </p>

    <div class="form-group">
        <label for="id_prof">Professeur</label>
        <select style="height:35px;"
        required="required" name="id_prof" id="id_prof" class="form-control <?php echo (isset($invalidFields) && in_array('id_prof', $invalidFields)) ? 'alert alert-danger' : ""?>">
        <?php foreach($profs as $prof): ?>
        <option value="<?php echo $prof->getId(); ?>" <?php if($cours->getProf()!=null && $cours->getProf()->getId()==$prof->getId()){echo 'selected';}?>><?php echo $prof->getPrenom().' '.$prof->getNom(); ?></option>
        <?php endforeach; ?>
        </select>    
    </div>

    </p>
    </br>
    <p class="submit-container"><input type="submit" class="btn btn-dark" value="VALIDER"/></p>
    <input type="hidden" name="id" value="<?php echo htmlentities($cours->getId()); ?>"/>
</form>