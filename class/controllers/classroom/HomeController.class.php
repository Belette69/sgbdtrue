<?php


namespace sgbdtrue\controllers\classroom;


use sgbdtrue\DAO\classroom\MysqlUserDao;
use sgbdtrue\entities\classroom\User;
use sgbdtrue\utils\classroom\MysqlConnection;
use sgbdtrue\views\classroom\HomeView;
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