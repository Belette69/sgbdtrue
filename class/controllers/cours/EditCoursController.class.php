<?php


namespace sgbdtrue\controllers\cours;

use sgbdtrue\DAO\cours\MysqlCoursDao;
use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\cours\EditCoursView;
use sgbdtrue\views\cours\HomeView;
use sgbdtrue\controllers\IController;
class EditCoursController extends AAlterCoursController implements IController
{
    public function doAction()
    {
        $data = array();
        $isTransactioStarted = false;
        $pdo = null;
        try {
            if (!isset($_GET["id"]))
                throw new InvalidActionException("Id manquant");
            $id = (int)$_GET["id"];

            $pdo = MysqlConnection::getConnection();
            $coursDao = new MysqlCoursDao($pdo);

            $cours = $coursDao->findById($id);

            if ($cours === null)
                throw new InvalidActionException("Impossible de retrouver l'id du cours ");
            
            $data['cours'] = $cours;
            $profDao=new MysqlProfDao($pdo);
            $data['profs']=$profDao->findAll();
            $view = new EditCoursView();
    
            $view->showView($data);
        }
        catch (\Exception $ex)
        {
            if ($ex instanceof InvalidActionException) {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=cours");
                return;
            }
            if ($ex instanceof \PDOException)
            {
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
            } else
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            if ($isTransactioStarted)
                $pdo->rollBack();
            header("Location: index.php");
        }
    }
}