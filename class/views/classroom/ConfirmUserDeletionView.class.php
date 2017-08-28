<?php

namespace sgbdtrue\views\classroom;


class ConfirmUserDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'classroom\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirm deletion";
    }

}