<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\entities\prof\Prof;
use sgbdtrue\controllers\IController;

abstract class AAlterProfController implements IController
{



    protected final function validPostedDataAndSet(Prof $prof)
    {
        $invalidFields = array();

        $prof->setPrenom(isset($_POST['prenom']) ? trim($_POST['prenom']) : "");
        if($prof->getPrenom() == "")
        {
            $invalidFields[] = 'prenom';
        }

        $prof->setNom(isset($_POST['nom']) ? trim($_POST['nom']) : "");
        if($prof->getNom() == "")
        {
            $invalidFields[] = 'nom';
        }

        $prof->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($prof->getEmail() == "" && filter_var($prof->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }

    }     
}