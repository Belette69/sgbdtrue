<?php

namespace sgbdtrue\views\prof;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ShowProfView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}