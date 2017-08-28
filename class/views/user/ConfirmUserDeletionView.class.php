<?php

namespace sgbdtrue\views\user;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ConfirmUserDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'user\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirm deletion";
    }

}