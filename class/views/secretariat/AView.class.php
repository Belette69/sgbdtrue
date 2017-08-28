<?php

namespace sgbdtrue\views\secretariat;


abstract class AView implements IView
{

    /**
     * @param array $data
     * @return void
     */
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