<?php

namespace sgbdtrue\views;


class LoginView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'login';
    }

    protected  function getTitle()
    {
        return "Login";
    }

}