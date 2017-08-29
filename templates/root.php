<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <style>


    
    </style>
</head>
<div class="container">
<body>
    <?php
    if(isset($error))
    {
        echo '<div class="erreur">'.htmlentities($error).'</div>';
    }
     
    
    $errorMessageList = \sgbdtrue\utils\ErrorMessageManager::getInstance()->getMessageList();


    foreach ($errorMessageList as $error)
    {
        echo '<div class="erreur">'.htmlentities($error).'</div>';
    }

    ?>

    <?php
        $fileToIncludePath = __DIR__.DIRECTORY_SEPARATOR.'subTemplates'.DIRECTORY_SEPARATOR.$templateName;
        if(file_exists($fileToIncludePath))
        {
            include $fileToIncludePath;
        }


    ?>

</body>
</div>  
</html>