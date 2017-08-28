<?php
session_start();
require_once __DIR__.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'autoloader.php';
if(isset($_GET['entities']))
{
    if($_GET['entities']=='user')
    {
        $entities='user';
    }
    else if($_GET['entities']=='prof')
    {
        $entities='prof';
    }
    else if($_GET['entities']=='secretariat')
    {
        $entities='secretariat';
    }
    else if($_GET['entities']=='classroom')
    {
        $entities='classroom';
    }
    else
    {
        $entities='Homepage';
    }

}
else
{
    $entities='Homepage';

}
if(!isset($_GET['action'])||$entities=='Homepage')
{
    
    $controller = new \sgbdtrue\controllers\HomepageController();
}
else if($_GET['action'] == 'create')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\CreateUserController';
    $controller = new $path();
}
else if($_GET['action'] == 'edit')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\EditUserController'; 
   $controller = new $path();
}
else if($_GET['action'] == 'delete')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\DeleteUserController';
    $controller = new $path();
}
else if($_GET['action'] == 'home')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\HomeController';
    $controller = new $path();
}
else
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\NotFoundController';
    $controller = new $path();
}




$controller->doAction();