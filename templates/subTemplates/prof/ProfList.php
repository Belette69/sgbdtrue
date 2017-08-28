
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th colspan="2">Actions</th>
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
            <td><?php echo htmlentities($prof->getEmaill());?></td>
            <td><a href="index.php?action=edit&amp;entities=prof&amp;id=<?php  echo htmlentities($prof->getId(), ENT_QUOTES) ?>">Edit</a></td>
            <td><a href="index.php?action=delete&amp;entities=prof&amp;id=<?php echo htmlentities($prof->getId(), ENT_QUOTES) ?>">Remove</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>