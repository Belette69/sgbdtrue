<?php
namespace sgbdtrue\controllers;
use sgbdtrue\views\LoginView;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\utils\ErrorMessageManager;
use sgbdtrue\entities\secretariat\Secretariat;
use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;

class LoginController implements IController
{
    public function doAction()
    {
        $data=array();
        if(isset($_POST['username']) AND isset($_POST['password'])){
            try{
                $username=htmlspecialchars($_POST['username']);
                $password=htmlspecialchars($_POST['password']);
                $pdo=MysqlConnection::getConnection();
                $secretariatDao=new MysqlSecretariatDao($pdo);
                $secretariat=$secretariatDao->findByPseudo($username);
                if($secretariat===null || (sha1($password)!=$secretariat->getPassword())){
                    ErrorMessageManager::getInstance()->addErrorMessage("Mauvais pseudo ou mot de passe");
                    
                }else{
                    $_SESSION['id_secretaire']=$secretariat->getId();
                    $_SESSION['name_secretaire']=$secretariat->getPrenom();
                    header("Location: index.php");
                }
            }catch(\PDOException $e){
                ErrorMessageManager::getInstance()->addErrorMessage("Service indisponible");
            }catch(\Exception $e){
                ErrorMessageManager::getInstance()->addErrorMessage($e->getMessage());
            }
        }
            
        $view = new LoginView();
        $view->showView($data);
        
        
    }
}