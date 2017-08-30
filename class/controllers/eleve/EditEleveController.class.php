<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\eleve\EditEleveView;
use sgbdtrue\views\eleve\HomeView;
use sgbdtrue\controllers\IController;

class EditEleveController extends AAlterEleveController implements IController
{

    public function doAction()
    {

        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new InvalidActionException("Id manquant");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);


            $eleve = $eleveDao->findById($id);
            

            if($eleve === null)
                throw new InvalidActionException("Impossible de retrouver l'élève avec cet ID");

            $notTakenCoursList=$eleveDao->getNotTakenCoursForThisEleve($eleve);
            $data['notTakenCoursList']=$notTakenCoursList;

            $data['eleve'] = $eleve;

            if(!isset($_POST['id']))
            {
                $view = new EditEleveView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($eleve);


            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $isTransactioStarted = $pdo->beginTransaction();
            $eleveDao->insertOrUpdate($eleve);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Élève correctement modifié");

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
                
            $view = new EditEleveView();
            $view->showView($data);



        }


    }
}