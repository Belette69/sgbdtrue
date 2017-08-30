<?php
namespace sgbdtrue\controllers\inscription;

use sgbdtrue\utils\MysqlConnection;
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
                throw new \Exception("Cours not found");
            }
            $eleveDao=new MysqlEleveDao($pdo);
            $eleve=$eleveDao->findById($eleveId);
            if($eleve===null){
                throw new \Exception("Eleve not found");
            }
            $inscriptionDao=new MysqlInscriptionDao($pdo);
            $inscriptionDao->delete($eleve,$cours);
            $pdo->commit();
            $_SESSION['flash_success']="Inscription annulée";


            header('Location: index.php?action=edit&entities=eleve&id='.$eleve->getId());

        }catch(\PDOException $e){
            if($isTransactionStarted){
                $pdo->rollBack();
            }
            if($e->getCode()=="23000"){
                $_SESSION['flash_error']="This relation already exists";
            }else{
                $_SESSION['flash_error']="Database not available";
            }
            echo $e->getMessage();
            //header('Location: /');
        }catch(\Exception $e){
            if($isTransactionStarted){
                $pdo->rollBack();
            }
            $_SESSION['flash_error']=$e->getMessage();
            //header('Location: /');
        }
        
    }
}