<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\secretariat\ConfirmSecretariatDeletionView;
use sgbdtrue\views\secretariat\EditSecretariatView;
use sgbdtrue\views\secretariat\HomeView;
use sgbdtrue\controllers\IController;

class DeleteSecretariatController implements IController
{

    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;


        try
        {
            if(!isset($_GET["id"]))
                throw new InvalidActionException("ID manquant");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $secretariatDao = new MysqlSecretariatDao($pdo);


            $secretariat = $secretariatDao->findById($id);
            

            if($secretariat === null)
                throw new InvalidActionException("Impossible de retrouver un secrétaire avec un tel ID");


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmSecretariatDeletionView();
                $view->showView(array('secretariat'=> $secretariat));
                return;
            }
            
            $secretariatDao->delete($secretariat);
            
            ErrorMessageManager::getInstance()->addSuccessMessage("Secretaire supprimé avec succes!");
            header("Location: index.php?action=home&entities=secretariat");



        }

        catch (\Exception $ex)
        {
            if($isTransactioStarted)
                $pdo->rollBack();

            ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            header("Location: index.php");
            return;



        }


    }
}