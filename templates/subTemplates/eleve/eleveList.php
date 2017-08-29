<style>
a:hover {
color: red;
}
a{
    color:black;
    text-decoration:underline;
    font-style: italic;
}
th{
    text-align: center;
}
td{
    text-align: center;
}
</style>
<table class="table table-striped">
    <thead class="thead-inverse">
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
    for($i=0, $count=count($eleveList); $i<$count; ++$i):
        $eleve = $eleveList[$i];

        ?>
        <tr>
            <td><?php echo htmlentities($eleve->getId());?></td>
            <td><?php echo htmlentities($eleve->getNom());?></td>
            <td><?php echo htmlentities($eleve->getPrenom());?></td>
            <td><?php echo htmlentities($eleve->getEmail());?></td>
            
            <td><a href="index.php?action=edit&amp;entities=eleve&amp;id=<?php  echo htmlentities($eleve->getId(), ENT_QUOTES) ?>">Editer</a></td>
            <td><a href="index.php?action=delete&amp;entities=eleve&amp;id=<?php echo htmlentities($eleve->getId(), ENT_QUOTES) ?>">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>