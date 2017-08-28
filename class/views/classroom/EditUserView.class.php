<?php

namespace sgbdtrue\views\classroom;


class EditUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'classroom\editUser';
    }

    protected  function getTitle()
    {
        return "Edit user";
    }

}