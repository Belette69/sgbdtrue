
<table>
    <thead>
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
            
            <td><a href="index.php?action=edit&amp;entities=cours&amp;id=<?php  echo htmlentities($cours->getId(), ENT_QUOTES) ?>">Editer</a></td>
            <td><a href="index.php?action=delete&amp;entities=cours&amp;id=<?php echo htmlentities($cours->getId(), ENT_QUOTES) ?>">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>