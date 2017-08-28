
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Local</th>

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
            <td><?php echo htmlentities($user->getlocal());?></td>
 
            <td><a href="index.php?action=edit&amp;entities=classroom&amp;id=<?php  echo htmlentities($user->getId(), ENT_QUOTES) ?>">Edit</a></td>
            <td><a href="index.php?action=delete&amp;entities=classroom&amp;id=<?php echo htmlentities($user->getId(), ENT_QUOTES) ?>">Remove</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>