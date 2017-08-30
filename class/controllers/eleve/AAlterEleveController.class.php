<?php


namespace sgbdtrue\controllers\eleve;

use sgbdtrue\entities\eleve\Eleve;
use sgbdtrue\controllers\IController;

abstract class AAlterEleveController implements IController
{



    protected final function validPostedDataAndSet(Eleve $eleve)
    {

        $invalidFields = array();

        $eleve->setNom(isset($_POST['nom']) ? trim($_POST['nom']) : "");
        if($eleve->getNom() == "")
        {
            $invalidFields[] = 'nom';
        }

        $eleve->setPrenom(isset($_POST['prenom']) ? trim($_POST['prenom']) : "");
        if($eleve->getPrenom() == "")
        {
            $invalidFields[] = 'prenom';
        }

        if(isset($_POST['email']) && filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $email=substr(htmlspecialchars(trim($_POST['email'])),0,100);
            $eleve->setEmail($email);
        }else{
            $invalidFields[]="email";
        }

        

       return $invalidFields;
    


    }
}