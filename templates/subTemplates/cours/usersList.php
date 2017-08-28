
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Mail</th>
        
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($userList); $i<$count; ++$i):
        /**
         * @var \sgbdtrue\entities\User $user
         */
        $user = $userList[$i];
        //if(!($user instanceof \sgbdtrue\entities\User))
           // continue;
        ?>
        <tr>
            <td><?php echo htmlentities($user->getId());?></td>
            <td><?php echo htmlentities($user->getNom());?></td>
            <td><?php echo htmlentities($user->getPrenom());?></td>
            <td><?php echo htmlentities($user->getEmail());?></td>
            
            <td><a href="index.php?action=edit&amp;entities=user&amp;id=<?php  echo htmlentities($user->getId(), ENT_QUOTES) ?>">Editer</a></td>
            <td><a href="index.php?action=delete&amp;entities=user&amp;id=<?php echo htmlentities($user->getId(), ENT_QUOTES) ?>">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>