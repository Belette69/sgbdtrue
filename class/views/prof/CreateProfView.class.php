<?php

namespace sgbdtrue\views\prof;


class CreateProfView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'prof\editProf';
    }

    protected  function getTitle()
    {
        return "Create prof";
    }

}