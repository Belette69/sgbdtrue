<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlSecretariatDao;
use sgbdtrue\entities\secretariat\Secretariat;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\secretariat\ShowSecretariatView;
use sgbdtrue\controllers\IController;

class ShowSecretariatController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['secretariat'] = new Secretariat();
        $data['secretariatList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $secretariatDao = new MysqlSecretariatDao($pdo);
            $data['secretariatList'] = $secretariatDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new ShowSecretariatView();
     
        $view->showView($data);

    }

}