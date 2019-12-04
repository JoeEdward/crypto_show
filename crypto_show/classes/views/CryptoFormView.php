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
<hr>
<form action="$action" method="$form_metod" enctype="multipart/form-data">
<div class="input-group">
<label for="name">Name</label><br>
<input type="text" placeholder="Type Here!" name="name">
</div>

<div class="input-group">
<label for="image">Image Upload</label><br>
<input type="file" name="image">
</div>

<div class="input-group">
<label for="private" style="padding-right: 0.5rem">Private</label>
<input type="checkbox" name="private">
</div>

<div class="input-group">
<button type="submit" name="route" value="process-new-machine">Submit</button>
</div>

</form> 
HTMLFORM;

    }
}