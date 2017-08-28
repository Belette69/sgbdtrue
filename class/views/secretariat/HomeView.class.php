<?php

namespace sgbdtrue\views\secretariat;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}