<?php


namespace sgbdtrue\controllers\cours;


use sgbdtrue\DAO\cours\MysqlCoursDao;
use sgbdtrue\exceptions\cours\InvalidActionException;
use sgbdtrue\exceptions\cours\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\cours\ConfirmCoursDeletionView;
use sgbdtrue\views\cours\EditCoursView;
use sgbdtrue\views\cours\HomeView;
use sgbdtrue\controllers\IController;

class DeleteCoursController implements IController
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
            $coursDao = new MysqlCoursDao($pdo);


            $cours = $coursDao->findById($id);

            if($cours === null)
                throw new InvalidActionException("Unable to retrieve the cours with id ".$id);


            if(!isset($_POST['confirmed']))
            {
                $view = new ConfirmCoursDeletionView();
                $view->showView(array('cours'=> $cours));
                return;
            }

            $coursDao->delete($cours);
            ErrorMessageManager::getInstance()->addMessage("cours supprimé avec succes!");
            header("Location: index.php?action=home&entities=cours");


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