<?php
namespace sgbdtrue\controllers\cours;

use sgbdtrue\DAO\cours\MysqlCoursDao;
use sgbdtrue\entities\cours\Cours;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\exceptions\InvalidDataException;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\cours\CreateCoursView;
use sgbdtrue\views\cours\EditCoursView;
use sgbdtrue\views\cours\HomeView;
use sgbdtrue\controllers\IController;
use sgbdtrue\utils\ErrorMessageManager;

class CreateCoursController extends AAlterCoursController implements IController
{
    public function doAction()
    {
        $data = array();
        $cours = new Cours();
        $data['coursList'] = array();
        $data['cours']=$cours;
        $pdo = null;
        $isTransactionStarted = false;
        
        try
        {
            $pdo = MysqlConnection::getConnection();
            $this->profDao=new MysqlProfDao($pdo);
            if(!isset($_POST['id']))
            { 
                $data['profs']=$this->profDao->findAll();
                $view = new CreateCoursView();
                $view->showView($data);
                return;
            }

            $this->idsProf=$this->profDao->getIds();
            $invalidFields = $this->validPostedDataAndSet($cours);

            if(count($invalidFields) > 0)
                throw new InvalidDataException("Données soumises invalides", $invalidFields);
            $action=($cours->getId()=="")?'ajouté':'modifié';
            
            $coursDao = new MysqlCoursDao($pdo);
            $isTransactionStarted = $pdo->beginTransaction();
            $coursDao->insertOrUpdate($cours);
            $pdo->commit();
            
            ErrorMessageManager::getInstance()->addSuccessMessage("Cours correctement ".$action);
            header("Location: index.php?action=home&entities=cours");
        }
        catch (\Exception $ex)
        {
            if($ex instanceof  \PDOException && $ex->getCode() == 23000)
            {
                ErrorMessageManager::getInstance()->addErrorMessage("Ce cours existe déjà");
                $data['invalidFields'] = array('intitule');
            }else if($ex instanceof InvalidDataException)
            {
                $data['invalidFields'] = $ex->getInvalidData();
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            }else
            {
                ErrorMessageManager::getInstance()->addErrorMessage($ex->getMessage());
            }
            if($isTransactionStarted)
                $pdo->rollBack();
            $data['cours'] = $cours;
            $data['profs']=$this->profDao->findAll();
            if(!isset($_POST['id'])){
                $view = new CreateCoursView();
            }else{
                $view= new EditCoursView();
            }
            
            $view->showView($data);
        }
    }
}