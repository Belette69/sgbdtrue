<?php

namespace sgbdtrue\views\prof;


class CreateUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editUser';
    }

    protected  function getTitle()
    {
        return "Create user";
    }

}