<?php

namespace sgbdtrue\views\prof;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class CreateProfView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editProf';
    }

    protected  function getTitle()
    {
        return "Create prof";
    }

}