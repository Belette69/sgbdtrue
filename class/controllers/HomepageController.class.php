<?php


namespace sgbdtrue\controllers;


use sgbdtrue\views\HomepageView;
use sgbdtrue\controllers\IController;


class HomepageController implements IController
{

    public function doAction()
    {
        $data = array();
        $view = new HomepageView();
        $view->showView($data);

    }

}