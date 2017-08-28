<?php

namespace sgbdtrue\views\secretariat;


class CreateUserView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\editUser';
    }

    protected  function getTitle()
    {
        return "Créer secrétaire";
    }

}