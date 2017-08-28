<?php

namespace sgbdtrue\views\prof;


class EditUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editUser';
    }

    protected  function getTitle()
    {
        return "Edit user";
    }

}