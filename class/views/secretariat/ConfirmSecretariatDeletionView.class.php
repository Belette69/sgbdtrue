<?php

namespace sgbdtrue\views\secretariat;

use sgbdtrue\views\AView;
use sgbdtrue\views\IView;
class ConfirmSecretariatDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'secretariat\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation de suppression du secrétaire";
    }

}