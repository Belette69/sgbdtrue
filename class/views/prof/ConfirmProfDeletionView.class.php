<?php

namespace sgbdtrue\views\prof;


class ConfirmProfDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirm deletion";
    }

}