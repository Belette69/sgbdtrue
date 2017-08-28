<?php

namespace sgbdtrue\views;


abstract class AView implements IView
{


    public final function showView(array $data)
    {
        extract($data);

        $title = $this->getTitle();
        $templateName = $this->getTemplateNameWithoutExt().'.php';
        include './templates/root.php';
    }

    /**
     * @return string
     */
    protected abstract function getTitle();
    /**
     * @return string
     */
    protected abstract function getTemplateNameWithoutExt();

}