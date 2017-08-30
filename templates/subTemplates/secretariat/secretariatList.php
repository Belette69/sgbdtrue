
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Email</th>
        <th>Numero</th>
        <th>Pseudo</th>
        <th>Password</th>
        
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($secretariatList); $i<$count; ++$i):
        /**
         * @var \sgbdtrue\entities\Secretariat $secretariat
         */
        $secretariat = $secretariatList[$i];
        //if(!($secretariat instanceof \sgbdtrue\entities\Secretariat))
           // continue;
        ?>
        <tr>
            <td><?php echo htmlentities($secretariat->getId());?></td>
            <td><?php echo htmlentities($secretariat->getNom());?></td>
            <td><?php echo htmlentities($secretariat->getPrenom());?></td>
            <td><?php echo htmlentities($secretariat->getEmail());?></td>
            <td><?php echo htmlentities($secretariat->getNumero());?></td>
            <td><?php echo htmlentities($secretariat->getPseudo());?></td>
            <td><?php echo htmlentities($secretariat->getPassword());?></td>
            
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