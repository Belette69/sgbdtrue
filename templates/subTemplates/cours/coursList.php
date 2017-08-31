
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th><span class="glyphicon glyphicon-eye-open"></span> Id</th>
        <th><span class="glyphicon glyphicon-duplicate"></span> Intitule</th>
        <th><span class="glyphicon glyphicon-hourglass"></span> Nombre de périodes</th>
        <th><span class="glyphicon glyphicon-education"></span> Professeur</th>
        <th><span class="glyphicon glyphicon-hourglass"></span> Année scolaire</th>
        
        <th colspan="2"><span class="glyphicon glyphicon-wrench"></span> Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($coursList); $i<$count; ++$i):
        $cours = $coursList[$i];
        ?>
        <tr>
            <td><?php echo htmlentities($cours->getId());?></td>
            <td><?php echo htmlentities($cours->getIntitule());?></td>
            <td><?php echo htmlentities($cours->getPeriode());?></td>
            <td><?php echo htmlentities($cours->getProf()->getNom().' '.$cours->getProf()->getPrenom());?></td>
            <td><?php echo htmlentities($cours->getAnneeScolaire());?></td>
            <td><a href="index.php?action=edit&amp;entities=cours&amp;id=<?php  echo htmlentities($cours->getId(), ENT_QUOTES) ?>"><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-pencil"></span> Editer </button></a></td>
            <td><a href="index.php?action=delete&amp;entities=cours&amp;id=<?php echo htmlentities($cours->getId(), ENT_QUOTES) ?>"><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-remove"></span> Supprimer </button></a></td>
            
            

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>

