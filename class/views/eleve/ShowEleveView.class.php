<?php

namespace sgbdtrue\views\eleve;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ShowEleveView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'eleve\default';
    }

    protected  function getTitle()
    {
        return "List of eleves";
    }

}