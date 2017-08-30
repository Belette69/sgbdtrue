<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\prof\EditProfView;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class EditProfController extends AAlterProfController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new \InvalidActionException("ID manquant");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $profDao = new MysqlProfDao($pdo);


            $prof = $profDao->findById($id);

            if($prof === null)
                throw new InvalidActionException("Impossible de trouver un professeur avec cet ID");

            $data['prof'] = $prof;

            if(!isset($_POST['id']))
            {
                $view = new EditProfView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($prof);


            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $isTransactioStarted = $pdo->beginTransaction();
            $profDao->insertOrUpdate($prof);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Professeur correctement modifié");
            header("Location: index.php?action=home&entities=prof");


        }

        catch (\Exception $ex)
        {
            if($isTransactioStarted)
                $pdo->rollBack();
            
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=prof");
                return;
            }else if($ex instanceof InvalidDataException){
                $data['invalidFields'] = $ex->getInvalidData();
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            }else if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "L'email existe déjà.";
                $data['invalidFields'] = array("email");
            }
            else{
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
                header("Location: index.php");
            }
                
            $view = new EditProfView();
            $view->showView($data);



        }


    }
}