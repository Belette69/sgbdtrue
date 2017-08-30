<?php

namespace sgbdtrue\views\prof;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class ConfirmProfDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation de suppression du professeur";
    }

}