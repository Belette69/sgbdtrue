<?php


namespace sgbdtrue\controllers\cours;


use sgbdtrue\entities\cours\Gender;
use sgbdtrue\entities\cours\User;
use sgbdtrue\controllers\IController;

abstract class AAlterUserController implements IController
{



    protected final function validPostedDataAndSet(User $user)
    {

        $invalidFields = array();

        $user->setintitule(isset($_POST['intitule']) ? trim($_POST['intitule']) : "");
        if($user->getintitule() == "")
        {
            $invalidFields[] = 'intitule';
        }

        $user->setperiode(isset($_POST['periode']) ? trim($_POST['periode']) : "");
        if($user->getperiode() == "")
        {
            $invalidFields[] = 'periode';
        }

        


    }
}