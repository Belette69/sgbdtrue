<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\entities\secretariat\Secretariat;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\secretariat\CreateSecretariatView;
use sgbdtrue\views\secretariat\ShowSecretariatView;
use sgbdtrue\controllers\IController;





class CreateSecretariatController extends AAlterSecretariatController implements IController
{
    public function doAction()
     {
        

        $secretariat = new Secretariat();
        $data['secretariat'] = $secretariat;
        $data['secretariatList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
       try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateSecretariatView();
                $view->showView($data);
                return;
            }
            
            
            $invalidFields = $this->validPostedDataAndSet($secretariat);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $secretariatDao = new MysqlSecretariatDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $secretariatDao->insertOrUpdate($secretariat);
            $pdo->commit();
            header("Location: index.php?action=home&entities=secretariat");
                
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

           $view = new CreateSecretariatView();
           $view->showView($data);

       }



    }



}