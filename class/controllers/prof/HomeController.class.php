<?php


namespace sgbdtrue\controllers\prof;


use sgbdtrue\DAO\prof\MysqlUserDao;
use sgbdtrue\entities\prof\User;
use sgbdtrue\utils\prof\MysqlConnection;
use sgbdtrue\views\prof\HomeView;
use sgbdtrue\controllers\IController;

class HomeController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['user'] = new User();
        $data['userList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $userDao = new MysqlUserDao($pdo);
            $data['userList'] = $userDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new HomeView();
        $view->showView($data);

    }

}