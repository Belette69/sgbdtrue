<?php

namespace sgbdtrue\views\cours;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class CreateCoursView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'cours\editCours';
    }

    protected  function getTitle()
    {
        return "Create cours";
    }

}