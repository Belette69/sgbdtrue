<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\entities\prof\Gender;
use sgbdtrue\entities\prof\User;
use sgbdtrue\controllers\IController;

abstract class AAlterUserController implements IController
{



    protected final function validPostedDataAndSet(User $user)
    {

        $invalidFields = array();

        $user->setFirstName(isset($_POST['firstName']) ? trim($_POST['firstName']) : "");
        if($user->getFirstName() == "")
        {
            $invalidFields[] = 'firstName';
        }

        $user->setLastName(isset($_POST['lastName']) ? trim($_POST['lastName']) : "");
        if($user->getLastName() == "")
        {
            $invalidFields[] = 'lastName';
        }

        $user->setEmail(isset($_POST['email']) ? trim($_POST['email']) : "");
        if($user->getEmail() == "" && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL))
        {
            $invalidFields[] = 'email';
        }

        $user->setGender(isset($_POST['gender']) ? trim($_POST['gender']) : Gender::M);

        return $invalidFields;


    }
}