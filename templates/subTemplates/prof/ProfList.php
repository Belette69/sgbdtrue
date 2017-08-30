
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th><span class="glyphicon glyphicon-eye-open"></span> Id</th>
        <th><span class="glyphicon glyphicon-star"></span> Prénom</th>
        <th><span class="glyphicon glyphicon-star-empty"></span> Nom</th>
        <th><span class="glyphicon glyphicon-envelope"></span> Email</th>
        <th colspan="2"><span class="glyphicon glyphicon-wrench"></span> Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($profList); $i<$count; ++$i):
        /**
         * @var \sgbdtrue\entities\Prof $prof
         */
        $prof = $profList[$i];
        //if(!($prof instanceof \sgbdtrue\entities\Prof))
           // continue;
        ?>
        <tr>
            <td><?php echo htmlentities($prof->getId());?></td>
            <td><?php echo htmlentities($prof->getPrenom());?></td>
            <td><?php echo htmlentities($prof->getNom());?></td>
            <td><?php echo htmlentities($prof->getEmail());?></td>
            <td><a href="index.php?action=edit&amp;entities=prof&amp;id=<?php  echo htmlentities($prof->getId(), ENT_QUOTES) ?>"><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-pencil"></span> Editer </button></a></td>
            <td><a href="index.php?action=delete&amp;entities=prof&amp;id=<?php echo htmlentities($prof->getId(), ENT_QUOTES) ?>"><button type="button" class="btn btn-dark">
          <span class="glyphicon glyphicon-remove"></span> Supprimer </button></a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>