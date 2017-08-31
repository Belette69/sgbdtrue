<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\exceptions\InvalidActionException;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\secretariat\EditSecretariatView;
use sgbdtrue\views\secretariat\HomeView;
use sgbdtrue\controllers\IController;

class EditSecretariatController extends AAlterSecretariatController implements IController
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
                throw new InvalidActionException("Impossible de trouver un secretaire avec un tel ID");

            $data['secretariat'] = $secretariat;

            if(!isset($_POST['id']))
            {
                $view = new EditSecretariatView();
                $view->showView($data);
                return;
            }


            //On a soumis le formulaire
            $invalidFields = $this->validPostedDataAndSet($secretariat);


            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);

            $isTransactioStarted = $pdo->beginTransaction();
            $secretariatDao->insertOrUpdate($secretariat);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Secrétaire correctement modifié");
            header("Location: index.php?action=home&entities=secretariat");


        }

        catch (\Exception $ex)
        {
            if($ex instanceof InvalidActionException)
            {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
                header("Location: index.php?action=home&entities=secretariat");
                return;
            }

            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                $data['error'] = "Ce secretaire existe déjà";
            }
            else
                $data['error'] = $ex->getMessage();

            if($ex instanceof InvalidDataException)
                $data['invalidFields'] = $ex->getInvalidData();

            if($isTransactioStarted)
                $pdo->rollBack();



            $view = new EditSecretariatView();
            $view->showView($data);



        }


    }
}