<?php
spl_autoload_register(function ($className)
{

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $classNamePart = explode(DIRECTORY_SEPARATOR, $className);

    if(count($classNamePart) < 3)
        return;


    $rootNamespaceName = array_shift($classNamePart);

    if($rootNamespaceName != "sgbdtrue")
        return;

    $filePath = implode(DIRECTORY_SEPARATOR, $classNamePart);

    if(file_exists(__DIR__.DIRECTORY_SEPARATOR.$filePath.'.class.php'))
        require_once __DIR__.DIRECTORY_SEPARATOR.$filePath.'.class.php';
    else if(file_exists(__DIR__.'/'.$filePath.'.interface.php'))
        require_once __DIR__.DIRECTORY_SEPARATOR.$filePath.'.interface.php';





});