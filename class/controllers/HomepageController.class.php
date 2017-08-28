<?php


namespace sgbdtrue\controllers;


use sgbdtrue\DAO\user\MysqlUserDao;
use sgbdtrue\entities\user\User;
use sgbdtrue\utils\user\MysqlConnection;
use sgbdtrue\views\HomepageView;
use sgbdtrue\controllers\IController;


class HomepageController implements IController
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
        $view = new HomepageView();
        $view->showView($data);

    }

}