<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\exceptions\prof\InvalidActionException;
use sgbdtrue\exceptions\prof\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\prof\ConfirmProfDeletionView;
use sgbdtrue\views\prof\EditProfView;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class DeleteProfController implements IController
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
                throw new InvalidActionException("Impossible de retrouver le professeur avec cet ID");


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmProfDeletionView();
                $view->showView(array('prof'=> $prof));
                return;
            }

            $profDao->delete($prof);
            ErrorMessageManager::getInstance()->addSuccessMessage("Enseignant supprimé avec succes!");
            header("Location: index.php?action=home&entities=prof");


        }

        catch (\Exception $ex)
        {


            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            header("Location: index.php?action=home&entities=prof");
            return;




        }


    }
}