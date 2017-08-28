<?php


namespace sgbdtrue\controllers\classroom;


use sgbdtrue\entities\classroom\Gender;
use sgbdtrue\entities\classroom\User;
use sgbdtrue\controllers\IController;

abstract class AAlterUserController implements IController
{



    protected final function validPostedDataAndSet(User $user)
    {

        $invalidFields = array();

        $user->setlocal(isset($_POST['local']) ? trim($_POST['local']) : "");
        if($user->getlocal() == "")
        {
            $invalidFields[] = 'local';
        }

       


    }
}