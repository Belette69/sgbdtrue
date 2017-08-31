<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\entities\prof\Gender;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\views\prof\CreateProfView;
use sgbdtrue\views\prof\EditProfView;
use sgbdtrue\controllers\IController;

class CreateProfController extends AAlterProfController implements IController
{
    public function doAction()
    {

        $data = array();
        $prof = new Prof();
        $data['prof'] = $prof;
        $data['profList'] = array();
        $pdo = null;
        $isTransactioStarted = false;
        
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
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $pdo = MysqlConnection::getConnection();
            $profDao = new MysqlProfDao($pdo);
            $isTransactioStarted = $pdo->beginTransaction();

            $profDao->insertOrUpdate($prof);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Professeur ajouté avec succès !");
            header("Location: index.php?action=home&entities=prof"); 
            


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
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                $data['invalidFields'] = $ex->getInvalidData();
            }else if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'email existe déjà.";
                $data['invalidFields'] = array("email");
            }
            else{
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
                header("Location: index.php");
                return;
            }
                
            $view = new EditProfView();
            $view->showView($data);

       }



    }



}