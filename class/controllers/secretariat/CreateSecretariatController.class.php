<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\entities\secretariat\Secretariat;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\views\secretariat\CreateSecretariatView;
use sgbdtrue\views\secretariat\ShowSecretariatView;
use sgbdtrue\controllers\IController;





class CreateSecretariatController extends AAlterSecretariatController implements IController
{
    public function doAction()
     {
        
        $data = array();
        $secretariat = new Secretariat();
        $data['secretariat'] = $secretariat;
        $data['secretariatList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        
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
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $secretariatDao = new MysqlSecretariatDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $secretariatDao->insertOrUpdate($secretariat);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage('Secrétaire correctement ajouté');
            header("Location: index.php?action=home&entities=secretariat");
                
        }
       catch (\Exception $ex)
       {
            if($isTransactioStarted)
                $pdo->rollBack();
            
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=secretariat");
                return;
            }else if($ex instanceof InvalidDataException){
                $data['invalidFields'] = $ex->getInvalidData();
            }else if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "Ce secrétaire existe déjà";
                
            }
            else{
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
                header("Location: index.php");
            }
                
            $view = new CreateSecretariatView();
            $view->showView($data);

       }



    }



}