<?php
namespace sgbdtrue\controllers\inscription;

use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\DAO\cours\MysqlCoursDao;
use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\DAO\inscription\MysqlInscriptionDao;
use sgbdtrue\entities\Cours;
use sgbdtrue\entities\Eleve;
use sgbdtrue\controllers\IController;

class DeleteInscriptionController implements IController{
    public function doAction(){
        try{
            
            
            $eleveId=(isset($_GET['eleve']) ? (int)$_GET['eleve']:0);
            $coursId=(isset($_GET['cours']) ? (int)$_GET['cours']:0);
            $pdo=MysqlConnection::getConnection();
            
            $coursDao=new MysqlCoursDao($pdo);
            $isTransactionStarted=$pdo->beginTransaction();

            $cours=$coursDao->findById($coursId);
            if($cours===null){
                throw new \Exception("Cours pas trouvé");
            }
            $eleveDao=new MysqlEleveDao($pdo);
            $eleve=$eleveDao->findById($eleveId);
            if($eleve===null){
                throw new \Exception("Eleve pas trouvé");
            }
            $inscriptionDao=new MysqlInscriptionDao($pdo);
            $inscriptionDao->delete($eleve,$cours);
            $pdo->commit();
            ErrorMessageManager::getInstance()->addSuccessMessage("Inscription annulée");


            header('Location: index.php?action=edit&entities=eleve&id='.$eleve->getId());

        }catch(\PDOException $e){
            if($isTransactionStarted){
                $pdo->rollBack();
            }
            if($e->getCode()=="23000"){
                ErrorMessageManager::getInstance()->addErrorMessage("Cette inscription existe déjà");
            }else{
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
            }
            echo $e->getMessage();
            header('Location: index.php');
        }catch(\Exception $e){
            if($isTransactionStarted){
                $pdo->rollBack();
            }
            ErrorMessageManager::getInstance()->addErrorMessage($e->getMessage());
            header('Location: index.php');
        }
        
    }
}