<?php

namespace sgbdtrue\views\prof;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class EditProfView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editProf';
    }

    protected  function getTitle()
    {
        return "Editer un professeur";
    }

}