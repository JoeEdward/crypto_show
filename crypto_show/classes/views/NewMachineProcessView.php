<?php


class NewMachineProcessView extends WebPageTemplateView
{
public function __construct()
{

}
public function __destruct()
{
}

    public function createOutputPage()
    {
        parent::__construct();
        $this->setPageTitle();
        $this->createAppropriateOutputMessage();
        $this->createPageBody();
        $this->createWebPage();
    }

    public function getHtmlOutput() {
        return $this->html_page_output;
    }

    public function setStoreNewMachineDetailsResult($store_new_machine_details_results)
    {
        $this->store_new_machine_details_results = $store_new_machine_details_results;
    }

    public function setPageTitle() {
        $this->page_title = APP_NAME . "Success";
    }

    private function createAppropriateOutputMessage()
    {
        $output_content = '';
        if (isset($this->store_new_machine_details_results['input-error']))
        {
            if ($this->store_new_machine_details_results['input-error'])
            {
                $output_content .= $this->createErrorMessage();
            }
            else
            {
                $output_content .= $this->create_success_message();
            }
        }
        else
        {
            $output_content .= 'Ooops - something appears to have gone wrong.  Please try again later.';
        }
        $this->output_content = $output_content;
    }

    private function createPageBody()
    {
        $page_heading = 'Make a new machine';

        $this->html_page_content = <<< HTMLFORM
<h2>$page_heading</h2>
$this->output_content
HTMLFORM;
    }

    private function createErrorMessage()
    {
        $path_to_image = MEDIA_PATH . 'sad_face.jpg';
        $form_method = 'post';
        $form_action = APP_ROOT_PATH;

        $page_content = <<< HTMLOUTPUT
<p>Ooops - there appears to have been an error - please check that you correctly entered all the required values.</p>
<form method="$form_method" action="$form_action">
<p><button name="route" value="create-new-machine" /><img src="$path_to_image" alt="Sad face" /><br />Try again</button></p>
</form>
HTMLOUTPUT;
        return $page_content;
    }

    private function create_success_message()
    {
        $path_to_image = MEDIA_PATH . 'happy_face.jpg';
        $page_content = <<< HTMLOUTPUT
<p>You have been successfully registered.</p>
<p><button name="route" value="user_register" /><img src="$path_to_image" alt="Happy face" /></button></p>
HTMLOUTPUT;
        return $page_content;
    }


}