<?php


class CryptoFormController extends ControllerAbstract
{
    public function createHtmlOutput() {
        $view = Factory::buildObject('CryptoFormView');
        $view->createForm();
        $this->html_output = $view->getHtmlOutput();
    }

}