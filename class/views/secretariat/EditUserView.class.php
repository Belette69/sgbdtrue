<?php

namespace sgbdtrue\views\secretariat;


class EditUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\editUser';
    }

    protected  function getTitle()
    {
        return "Edit Secrétaire";
    }

}