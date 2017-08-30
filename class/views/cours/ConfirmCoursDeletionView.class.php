<?php

namespace sgbdtrue\views\cours;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ConfirmCoursDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'cours\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation de suppression du cours";
    }

}