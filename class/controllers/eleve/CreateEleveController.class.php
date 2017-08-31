<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\entities\eleve\Eleve;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\views\eleve\CreateEleveView;
use sgbdtrue\controllers\IController;





class CreateEleveController extends AAlterEleveController implements IController
{
    public function doAction()
     {
        $data = array();
        $eleve = new Eleve();
        $data['eleve'] = $eleve;
        $data['eleveList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        
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
                throw new InvalidDataException("Données fournies invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $eleveDao->insertOrUpdate($eleve);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Élève ajouté avec succès !");
            header("Location: index.php?action=home&entities=eleve");
                
        }
       catch (\Exception $ex)
       {
            if($isTransactioStarted)
                $pdo->rollBack();
            
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=eleve");
                return;
            }else if($ex instanceof InvalidDataException){
                $data['invalidFields'] = $ex->getInvalidData();
            }else if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'email existe déjà.";
                $data['invalidFields'] = array("email");
            }
            else{
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
                header("Location: index.php");
            }
                
            $view = new CreateEleveView();
            $view->showView($data);

       }



    }



}