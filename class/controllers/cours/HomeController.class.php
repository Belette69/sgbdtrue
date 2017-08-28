<?php


namespace sgbdtrue\controllers\cours;


use sgbdtrue\DAO\cours\MysqlUserDao;
use sgbdtrue\entities\cours\User;
use sgbdtrue\utils\cours\MysqlConnection;
use sgbdtrue\views\cours\HomeView;
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