<?php

namespace sgbdtrue\views\secretariat;
use sgbdtrue\views\AView;
use sgbdtrue\views\IView;

class CreateSecretariatView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\editSecretariat';
    }

    protected  function getTitle()
    {
        return "Création secrétaire";
    }

}