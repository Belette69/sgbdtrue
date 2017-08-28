<?php

namespace sgbdtrue\views\eleve;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ConfirmEleveDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'eleve\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirm deletion";
    }

}