<?php

namespace sgbdtrue\views\classroom;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'classroom\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}