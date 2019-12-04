<?php


class CryptoFormController extends ControllerAbstract
{
    public function createHtmlOutput() {
        $view = Factory::buildObject('CryptoFormView');
        $view->createRegisterForm();
        $this->html_output = $view->getHtmlOutput();
    }
}