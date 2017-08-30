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
                throw new \InvalidActionException("Missing id");

            $id = (int) $_GET["id"];


            $pdo = MysqlConnection::getConnection();
            $profDao = new MysqlProfDao($pdo);


            $prof = $profDao->findById($id);

            if($prof === null)
                throw new InvalidActionException("Unable to retrieve the prof with id ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmProfDeletionView();
                $view->showView(array('prof'=> $prof));
                return;
            }

            $profDao->delete($prof);
            ErrorMessageManager::getInstance()->addMessage("Enseignant supprimé avec succes!");
            header("Location: index.php?action=home&entities=prof");


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