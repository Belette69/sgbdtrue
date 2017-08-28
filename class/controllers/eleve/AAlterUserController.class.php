<?php


namespace sgbdtrue\controllers\user;


use sgbdtrue\entities\user\Gender;
use sgbdtrue\entities\user\User;
use sgbdtrue\controllers\IController;

abstract class AAlterUserController implements IController
{



    protected final function validPostedDataAndSet(User $user)
    {

        $invalidFields = array();

        $user->setNom(isset($_POST['nom']) ? trim($_POST['nom']) : "");
        if($user->getNom() == "")
        {
            $invalidFields[] = 'nom';
        }

        $user->setPrenom(isset($_POST['prenom']) ? trim($_POST['prenom']) : "");
        if($user->getPrenom() == "")
        {
            $invalidFields[] = 'prenom';
        }

        $user->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($user->getEmail() == "" && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }

        

       return $invalidFields;
    


    }
}