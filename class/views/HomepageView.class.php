<?php

namespace sgbdtrue\views;


class HomepageView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'homepage';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}