<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\exceptions\eleve\InvalidActionException;
use sgbdtrue\exceptions\eleve\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\eleve\ConfirmEleveDeletionView;
use sgbdtrue\views\eleve\EditEleveView;
use sgbdtrue\views\eleve\HomeView;
use sgbdtrue\controllers\IController;

class DeleteEleveController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new \InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);


            $eleve = $eleveDao->findById($id);
            

            if($eleve === null)
                throw new InvalidActionException("Unable to retrieve the eleve with id ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmEleveDeletionView();
                $view->showView(array('eleve'=> $eleve));
                return;
            }
            
            $eleveDao->delete($eleve);
            
            ErrorMessageManager::getInstance()->addMessage("Eleve removed with seccess!");
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


            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addMessage($ex->getMessage());
            header("Location: ".$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"]);
            return;



        }


    }
}