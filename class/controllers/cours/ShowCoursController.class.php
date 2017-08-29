<?php


namespace sgbdtrue\controllers\cours;


use sgbdtrue\DAO\cours\MysqlCoursDao;
use sgbdtrue\entities\cours\Cours;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\cours\ShowCoursView;
use sgbdtrue\controllers\IController;


class ShowCoursController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['cours'] = new Cours();
        $data['coursList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $coursDao = new MysqlCoursDao($pdo);
            $data['coursList'] = $coursDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new ShowCoursView();
        $view->showView($data);

    }

}