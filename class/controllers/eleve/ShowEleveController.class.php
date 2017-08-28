<?php


namespace sgbdtrue\controllers\eleve;


use sgbdtrue\DAO\eleve\MysqlEleveDao;
use sgbdtrue\entities\eleve\Eleve;
use sgbdtrue\utils\MysqlConnection;
use sgbdtrue\views\eleve\ShowEleveView;
use sgbdtrue\controllers\IController;

class ShowEleveController implements IController
{

    public function doAction()
    {
        $data = array();
        $data['eleve'] = new Eleve();
        $data['eleveList']  = array();

        try
        {
            $pdo = MysqlConnection::getConnection();
            $eleveDao = new MysqlEleveDao($pdo);
            $data['eleveList'] = $eleveDao->findAll();
        }
        catch (\Exception $ex)
        {
            $data['error'] = "Service indisponible";
        }
        $view = new ShowEleveView();
     
        $view->showView($data);

    }

}