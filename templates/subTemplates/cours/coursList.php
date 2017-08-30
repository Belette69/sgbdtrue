
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th>Id</th>
        <th>Intitule</th>
        <th>Nombre de périodes</th>
        <th>Professeur</th>
        
        <th colspan="2">Actions</th>
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

