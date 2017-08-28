<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlUserDao;
use sgbdtrue\entities\prof\Gender;
use sgbdtrue\entities\prof\User;
use sgbdtrue\exceptions\prof\InvalidDataException;
use sgbdtrue\utils\prof\MysqlConnection;
use sgbdtrue\views\prof\CreateUserView;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class CreateUserController extends AAlterUserController implements IController
{
    public function doAction()
    {


        $user = new User();
        $data['user'] = $user;
        $data['userList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
       try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateUserView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($user);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $userDao->insertOrUpdate($user);
            $pdo->commit();
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

           if($ex instanceof InvalidDataException)
               $data['invalidFields'] = $ex->getInvalidData();

           if($isTransactioStarted)
               $pdo->rollBack();

           $view = new CreateUserView();
           $view->showView($data);

       }



    }



}