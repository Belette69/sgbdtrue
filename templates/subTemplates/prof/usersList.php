
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Genre</th>
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
            <td><?php echo htmlentities($user->getprenom());?></td>
            <td><?php echo htmlentities($user->getnom());?></td>
            <td><?php echo htmlentities($user->getemaill());?></td>
            <td><?php echo htmlentities($user->getGender());?></td>
            <td><a href="index.php?action=edit&amp;entities=prof&amp;id=<?php  echo htmlentities($user->getId(), ENT_QUOTES) ?>">Edit</a></td>
            <td><a href="index.php?action=delete&amp;entities=prof&amp;id=<?php echo htmlentities($user->getId(), ENT_QUOTES) ?>">Remove</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>