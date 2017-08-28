<?php

namespace sgbdtrue\views\prof;


class EditProfView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editProf';
    }

    protected  function getTitle()
    {
        return "Edit prof";
    }

}