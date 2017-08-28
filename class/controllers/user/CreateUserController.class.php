<?php


namespace sgbdtrue\controllers\user;


use sgbdtrue\DAO\user\MysqlUserDao;
use sgbdtrue\entities\user\Gender;
use sgbdtrue\entities\user\User;
use sgbdtrue\exceptions\user\InvalidDataException;
use sgbdtrue\utils\user\MysqlConnection;
use sgbdtrue\views\user\CreateUserView;
use sgbdtrue\views\user\HomeView;
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
            header("Location: index.php?action=home&entities=user");
                
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