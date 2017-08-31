
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th><span class="glyphicon glyphicon-eye-open"></span> Id</th>
        <th><span class="glyphicon glyphicon-star"></span> Nom</th>
        <th><span class="glyphicon glyphicon-star-empty"></span>  Prenom</th>
        <th><span class="glyphicon glyphicon-envelope"></span>  Email</th>
        <th><span class="glyphicon glyphicon-earphone"></span> Numero</th>
        <th><span class="glyphicon glyphicon-user"></span> Pseudo</th>
        
        <th colspan="2"><span class="glyphicon glyphicon-wrench"></span> Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($secretariatList); $i<$count; ++$i):
        $secretariat = $secretariatList[$i];
        ?>
        <tr>
            <td><?php echo htmlentities($secretariat->getId());?></td>
            <td><?php echo htmlentities($secretariat->getNom());?></td>
            <td><?php echo htmlentities($secretariat->getPrenom());?></td>
            <td><?php echo htmlentities($secretariat->getEmail());?></td>
            <td><?php echo htmlentities($secretariat->getNumero());?></td>
            <td><?php echo htmlentities($secretariat->getPseudo());?></td>
            
            <td><a href="index.php?action=edit&amp;entities=secretariat&amp;id=<?php  echo htmlentities($secretariat->getId(), ENT_QUOTES) ?>" ><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-pencil"></span> Editer </button></a></td>
            <td><a href="index.php?action=delete&amp;entities=secretariat&amp;id=<?php echo htmlentities($secretariat->getId(), ENT_QUOTES) ?>"><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-remove"></span> Supprimer </button></a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>