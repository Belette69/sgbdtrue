<?php


namespace sgbdtrue\controllers\classroom;


use sgbdtrue\DAO\classroom\MysqlUserDao;
use sgbdtrue\entities\classroom\Gender;
use sgbdtrue\entities\classroom\User;
use sgbdtrue\exceptions\classroom\InvalidDataException;
use sgbdtrue\utils\classroom\MysqlConnection;
use sgbdtrue\views\classroom\CreateUserView;
use sgbdtrue\views\classroom\HomeView;
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