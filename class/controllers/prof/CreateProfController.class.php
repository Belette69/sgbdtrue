<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\entities\prof\Gender;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\prof\CreateProfView;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class CreateProfController extends AAlterProfController implements IController
{
    public function doAction()
    {


        $prof = new Prof();
        $data['prof'] = $prof;
        $data['profList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
       try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateProfView();
                $view->showView($data);
                return;
            }
            $invalidFields = $this->validPostedDataAndSet($prof);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $profDao = new MysqlProfDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $profDao->insertOrUpdate($prof);
            $pdo->commit();
           header("Location: index.php?action=home&entities=prof"); 
            


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

           $view = new CreateProfView();
           $view->showView($data);

       }



    }



}