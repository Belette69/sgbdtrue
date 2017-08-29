<?php


namespace sgbdtrue\controllers\secretariat;

use sgbdtrue\entities\secretariat\Secretariat;
use sgbdtrue\controllers\IController;

abstract class AAlterSecretariatController implements IController
{



    protected final function validPostedDataAndSet(Secretariat $secretariat)
    {

        $invalidFields = array();

        $secretariat->setNom(isset($_POST['nom']) ? trim($_POST['nom']) : "");
        if($secretariat->getNom() == "")
        {
            $invalidFields[] = 'nom';
        }

        $secretariat->setPrenom(isset($_POST['prenom']) ? trim($_POST['prenom']) : "");
        if($secretariat->getPrenom() == "")
        {
            $invalidFields[] = 'prenom';
        }

        $secretariat->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($secretariat->getEmail() == "" && filter_var($secretariat->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }
        $secretariat->setNumero(isset($_POST['numero']) ? trim($_POST['numero']) : "");
        if($secretariat->getNumero() == "")
        {
            $invalidFields[] = 'numero';
        }
        $secretariat->setPseudo(isset($_POST['pseudo']) ? trim($_POST['pseudo']) : "");
        if($secretariat->getPseudo() == "")
        {
            $invalidFields[] = 'pseudo';
        }
        $secretariat->setPassword(isset($_POST['password']) ? trim($_POST['password']) : "");
        if($secretariat->getPassword() == "")
        {
            $invalidFields[] = 'password';
        }

        

       return $invalidFields;
    


    }
}