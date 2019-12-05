<?php

class ListMachinesController extends ControllerAbstract {

    public function createHtmlOutput()

        {
            $view = Factory::buildObject('ListMachinesView');
            $view->createOutput();
            $this->html_output = $view->getHtmlOutput();
        }


}