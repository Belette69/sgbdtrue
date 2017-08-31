<?php

namespace sgbdtrue\views\eleve;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class EditEleveView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'eleve\editEleve';
    }

    protected  function getTitle()
    {
        return "Editer un élève";
    }

}