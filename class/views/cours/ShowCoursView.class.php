<?php

namespace sgbdtrue\views\cours;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ShowCoursView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'cours\default';
    }

    protected  function getTitle()
    {
        return "List of cours";
    }

}