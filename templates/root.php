<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/superhero/bootstrap.min.css" rel="stylesheet" integrity="sha384-Xqcy5ttufkC3rBa8EdiAyA1VgOGrmel2Y+wxm4K3kI3fcjTWlDWrlnxyD6hOi3PF" crossorigin="anonymous">
    <style>
    
    </style>

    
    
        


    
</head>
<body>
    <?php
    if(isset($error))
    {
        echo '<div class="erreur">'.htmlentities($error).'</div>';
    }
     
    
    $errorMessageList = \sgbdtrue\utils\user\ErrorMessageManager::getInstance()->getMessageList();


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
</html>