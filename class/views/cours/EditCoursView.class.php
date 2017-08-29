<?php

namespace sgbdtrue\views\cours;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class EditCoursView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'cours\editCours';
    }

    protected  function getTitle()
    {
        return "Edit cours";
    }

}