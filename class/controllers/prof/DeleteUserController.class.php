<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlUserDao;
use sgbdtrue\exceptions\prof\InvalidActionException;
use sgbdtrue\exceptions\prof\InvalidDataException;
use sgbdtrue\utils\prof\ErrorMessageManager;
use sgbdtrue\utils\prof\MysqlConnection;
use sgbdtrue\views\prof\ConfirmUserDeletionView;
use sgbdtrue\views\prof\EditUserView;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class DeleteUserController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new \InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);


            $user = $userDao->findById($id);

            if($user === null)
                throw new InvalidActionException("Unable to retrieve the user with id ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmUserDeletionView();
                $view->showView(array('user'=> $user));
                return;
            }

            $userDao->delete($user);
            ErrorMessageManager::getInstance()->addMessage("User removed with seccess!");
            header("Location: ".$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"]);


        }

        catch (\Exception $ex)
        {


            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "The email already exists";
                $data['invalidFields'] = array("email");
            }
            else
                $data['error'] = $ex->getMessage();


            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
            header("Location: ".$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"]);
            return;



        }


    }
}