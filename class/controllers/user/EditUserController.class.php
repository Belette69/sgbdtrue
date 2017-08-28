<?php


namespace sgbdtrue\controllers\user;


use sgbdtrue\DAO\user\MysqlUserDao;
use sgbdtrue\exceptions\user\InvalidActionException;
use sgbdtrue\exceptions\user\InvalidDataException;
use sgbdtrue\utils\user\ErrorMessageManager;
use sgbdtrue\utils\user\MysqlConnection;
use sgbdtrue\views\user\EditUserView;
use sgbdtrue\views\user\HomeView;
use sgbdtrue\controllers\IController;

class EditUserController extends AAlterUserController implements IController
{

    public function doAction()
         {

        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);


            $user = $userDao->findById($id);

            if($user === null)
                throw new InvalidActionException("Unable to retrieve the user with id ".$id);

            $data['user'] = $user;

            if(!isset($_POST['id']))
            {
                $view = new EditUserView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($user);


            if(count($invalidFields) > 0)
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $isTransactioStarted = $pdo->beginTransaction();
            $userDao->insertOrUpdate($user);
            $pdo->commit();

            header("Location: index.php?action=home&entities=user");


        }

        catch (\Exception $ex)
        {
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=user");
                return;
            }

            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "The email already exists";
                $data['invalidFields'] = array("email");
            }
            else
                $data['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();



            $view = new EditUserView();
            $view->showView($data);



        }


    }
}