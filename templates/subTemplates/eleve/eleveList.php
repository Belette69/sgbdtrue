
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th><span class="glyphicon glyphicon-eye-open"></span> Id</th>
        <th><span class="glyphicon glyphicon-star"></span> Nom</th>
        <th><span class="glyphicon glyphicon-star-empty"></span>  Prenom</th>
        <th><span class="glyphicon glyphicon-envelope"></span> Mail</th>
        
        <th colspan="2"><span class="glyphicon glyphicon-wrench"></span> Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($eleveList); $i<$count; ++$i):
        $eleve = $eleveList[$i];

        ?>
        <tr>
            <td><?php echo htmlentities($eleve->getId());?></td>
            <td><?php echo htmlentities($eleve->getNom());?></td>
            <td><?php echo htmlentities($eleve->getPrenom());?></td>
            <td><?php echo htmlentities($eleve->getEmail());?></td>
            
            <td><a href="index.php?action=edit&amp;entities=eleve&amp;id=<?php  echo htmlentities($eleve->getId(), ENT_QUOTES) ?>"><!--<h6>Editer</h6>--><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-pencil"></span> Editer </button></a></td>
            <td><a href="index.php?action=delete&amp;entities=eleve&amp;id=<?php echo htmlentities($eleve->getId(), ENT_QUOTES) ?>"><!--<h6>Supprimer</h6>--><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-remove"></span> Supprimer </button></a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>