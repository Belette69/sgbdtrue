<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlProfDao;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\utils\prof\MysqlConnection;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['prof'] = new Prof();
        $data['profList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $profDao = new MysqlProfDao($pdo);
            $data['profList'] = $profDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomeView();
        $view->showView($data);

    }

}