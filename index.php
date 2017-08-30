<?php
session_start();
require_once __DIR__.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'autoloader.php';
if(isset($_GET['entities']))
{
    if($_GET['entities']=='eleve')
    {
        $entities='eleve';
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
    else if($_GET['entities']=='cours')
    {
        $entities='cours';
    }
    else if($_GET['entities']=='inscription')
    {
        $entities='inscription';
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
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\Create'.ucfirst($entities).'Controller';
    $controller = new $path();
}
else if($_GET['action'] == 'edit')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\Edit'.ucfirst($entities).'Controller'; 
   $controller = new $path();
}
else if($_GET['action'] == 'delete')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\Delete'.ucfirst($entities).'Controller';
    $controller = new $path();
}
else if($_GET['action'] == 'home')
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\Show'.ucfirst($entities).'Controller';
    $controller = new $path();
}
else
{
    $path = '\\sgbdtrue\\controllers\\'.$entities.'\\NotFoundController';
    $controller = new $path();
}




$controller->doAction();