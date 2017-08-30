<?php

namespace sgbdtrue\views\eleve;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class CreateEleveView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'eleve\createEleve';
    }

    protected  function getTitle()
    {
        return "Create eleve";
    }

}