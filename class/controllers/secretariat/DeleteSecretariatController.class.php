<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\exceptions\secretariat\InvalidActionException;
use sgbdtrue\exceptions\secretariat\InvalidDataException;
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
                throw new \InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $secretariatDao = new MysqlSecretariatDao($pdo);


            $secretariat = $secretariatDao->findById($id);
            

            if($secretariat === null)
                throw new InvalidActionException("Unable to retrieve the secretariat with id ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmSecretariatDeletionView();
                $view->showView(array('secretariat'=> $secretariat));
                return;
            }
            
            $secretariatDao->delete($secretariat);
            
            ErrorMessageManager::getInstance()->addMessage("Secretaire supprimé avec succes!");
            header("Location: index.php?action=home&entities=secretariat");



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