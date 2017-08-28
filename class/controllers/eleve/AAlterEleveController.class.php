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

        $eleve->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($eleve->getEmail() == "" && filter_var($eleve->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }

        

       return $invalidFields;
    


    }
}