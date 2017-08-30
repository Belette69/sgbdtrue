<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
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
                throw new InvalidActionException("Impossible de trouver un élève avec l'id: ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmEleveDeletionView();
                $view->showView(array('eleve'=> $eleve));
                return;
            }
            
            $eleveDao->delete($eleve);
            
            ErrorMessageManager::getInstance()->addSuccessMessage("Élève supprimé avec succès !");
            header("Location: index.php?action=home&entities=eleve");



        }

        catch (\Exception $ex)
        {

            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            header("Location: index.php?action=home&entities=eleve");
            return;

        }


    }
}