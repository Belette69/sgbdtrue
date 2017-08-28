<?php

namespace sgbdtrue\views\user;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class CreateUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'user\editUser';
    }

    protected  function getTitle()
    {
        return "Create user";
    }

}