<?php


namespace sgbdtrue\controllers\secretariat;


use sgbdtrue\DAO\secretariat\MysqlUserDao;
use sgbdtrue\entities\secretariat\User;
use sgbdtrue\utils\secretariat\MysqlConnection;
use sgbdtrue\views\secretariat\HomeView;
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