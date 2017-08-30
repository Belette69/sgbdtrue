<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\exceptions\eleve\InvalidActionException;
use sgbdtrue\exceptions\eleve\InvalidDataException;
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
                throw new InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);


            $eleve = $eleveDao->findById($id);
            

            if($eleve === null)
                throw new InvalidActionException("Unable to retrieve the eleve with id ".$id);

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
                throw new InvalidDataException("Invalid submitted datas", $invalidFields);

            $isTransactioStarted = $pdo->beginTransaction();
            $eleveDao->insertOrUpdate($eleve);
            $pdo->commit();

            header("Location: index.php?action=home&entities=eleve");


        }

        catch (\Exception $ex)
        {
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=eleve");
                return;
            }

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



            $view = new EditEleveView();
            $view->showView($data);



        }


    }
}