<?php

namespace sgbdtrue\views\secretariat;


class ConfirmUserDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirm deletion";
    }

}