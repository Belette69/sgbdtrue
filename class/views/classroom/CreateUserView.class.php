<?php

namespace sgbdtrue\views\classroom;


class CreateUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'classroom\editUser';
    }

    protected  function getTitle()
    {
        return "Create user";
    }

}