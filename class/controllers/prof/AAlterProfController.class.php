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

        if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email=substr(htmlspecialchars(trim($_POST['email'])),0,100);
            $prof->setEmail($email);
        }else{
            $invalidFields[]="email";
        }

        return $invalidFields;

    }     
}