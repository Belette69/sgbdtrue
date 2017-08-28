<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\entities\eleve\Eleve;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\eleve\CreateEleveView;
use sgbdtrue\views\eleve\ShowEleveView;
use sgbdtrue\controllers\IController;





class CreateEleveController extends AAlterEleveController implements IController
{
    public function doAction()
     {
        

        $eleve = new Eleve();
        $data['eleve'] = $eleve;
        $data['eleveList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        $data = array();
       try
        {

            if(!isset($_POST['id']))
            {
                $view = new CreateEleveView();
                $view->showView($data);
                return;
            }
            
            
            $invalidFields = $this->validPostedDataAndSet($eleve);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $eleveDao->insertOrUpdate($eleve);
            $pdo->commit();
            header("Location: index.php?action=home&entities=eleve");
                
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

           $view = new CreateEleveView();
           $view->showView($data);

       }



    }



}