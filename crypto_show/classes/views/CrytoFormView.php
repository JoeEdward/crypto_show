<?php


class CryptoFormView extends WebPageTemplateView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
    }

    public function createForm() {
        $this->setPageTitle();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput()
    {
        return $this->html_page_output;
    }

    private function setPageTitle()
    {
        $this->page_title = APP_NAME . ' Create new machine';
    }

    private function createPageBody()
    {
        $page_heading = "Create a new machine";
        $action = APP_ROOT_PATH;
        $form_metod = "POST";

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
<form action="$action" method="$form_metod" enctype="multipart/form-data">
<input type="text" placeholder="Hello">
</form> 
HTMLFORM;
    }
}