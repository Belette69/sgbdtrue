<?php
namespace sgbdtrue\controllers;
class LogoutController implements IController{
    public function doAction(){
        session_destroy();
        header('Location: index.php');
    }
}