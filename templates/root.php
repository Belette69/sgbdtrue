<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">-->
    <link rel="stylesheet" href="bootstrap-4.0.0-beta\dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" TYPE="text/css" href="design.css">
    

</head>
<div class="container">
<body>
    <?php
    if(isset($error))
    {
        echo '<div class="alert alert-danger" role="alert">'.htmlentities($error).'</div>';
    }
     
    
    $errorMessageList = \sgbdtrue\utils\ErrorMessageManager::getInstance()->getErrorMessageList();
    $successMessageList = \sgbdtrue\utils\ErrorMessageManager::getInstance()->getSuccessMessageList();

    foreach ($errorMessageList as $error)
    {
        echo '<div class="alert alert-danger" role="alert">'.htmlentities($error).'</div>';
    }

    foreach($successMessageList as $success){
        echo '<div class="alert alert-success" role="alert">'.htmlentities($success).'</div>';
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