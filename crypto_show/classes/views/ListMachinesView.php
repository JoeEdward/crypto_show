<?php

class ListMachinesView extends WebPageTemplateView
{

    public function __construct()
    {
        parent::__construct();
    }

    public function  __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function createOutput(){
        $this->setPageTitle();
        $this->createPageBody();
        $this->createWebpage();
    }


    public function createPageBody()
    {
        $cryptoNames = SqlQuery::queryGetCryptoMachineNames();
        var_dump($cryptoNames);
        $results = $this->database_handle->
        $this->html_page_content = <<<HTML

        
        <select>
        <option value = "Test_1">$cryptoNames[0]</option>
        <option value = "Test_2">Test 2</option>
        <option value = "Test_3">Test 3</option>
</select>
HTML;
    }
        public function setPageTitle(){
            $this->page_title = 'Test';
        }

        public function getHtmlOutput(){
            return $this->html_page_output;
        }



}