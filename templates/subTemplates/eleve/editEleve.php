<h1><?php echo htmlentities($title);?></h1>
<?php

include __DIR__.DIRECTORY_SEPARATOR.'eleveForm.php';
?>
<h3>Liste des cours</h3>
<ul>
    <?php
    foreach($eleve->getListeCours() as $cours){
    ?>
        <li><?php echo $cours->getIntitule();?> <a href="index.php?action=delete&amp;entities=inscription&amp;eleve=<?php echo $eleve->getId(); ?>&amp;cours=<?php echo $cours->getId(); ?>">X</a> </li>
    <?php
    }
    ?>
</ul>
<h3>Ajouter un nouveau cours</h3>
<form action="index.php?action=create&amp;entities=inscription" method="post">
    <select name="id_cours">
        <?php foreach($notTakenCoursList as $cours): ?>
            <option value="<?php echo $cours->getId(); ?>"><?php echo $cours->getIntitule(); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="id_eleve" value="<?php echo $eleve->getId(); ?>"/>
    <button type="submit" class="btn btn-dark">Ajouter</button>
</form>