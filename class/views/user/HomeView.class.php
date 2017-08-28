<?php

namespace sgbdtrue\views\user;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'user\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}