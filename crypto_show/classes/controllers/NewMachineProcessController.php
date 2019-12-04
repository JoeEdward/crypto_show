<?php


class NewMachineProcessController extends ControllerAbstract
{
    public function createHtmlOutput()
    {
        $input_error = true;
        $register_new_machine_result = [];

        $validated_input = $this->validate();
        $input_error = $validated_input['input-error'];

        if (!$input_error)
        {
            $register_new_machine_result = $this->registerNewMachine($validated_input);
        }

        $this->html_output = $this->createView($register_new_machine_result);
    }

    private function validate()
    {
        $validate = Factory::buildObject('Validate');
        $tainted = $_POST;
        $files = $_FILES;

        $check = isset($_POST['private']);

        $cleaned['validated-machine-name'] = $validate->validateString('name', $tainted, 3, 20);
        $cleaned['validated-machine-image'] = $validate->validateImage('image', $tainted, 50000000);
        $cleaned['validated-machine-private'] = $validate->validateCheckbox('private', $tainted);
        $cleaned['input-error'] = $validate->checkForError($cleaned);
        return $cleaned;
    }

    private function registerNewMachine($validated_input)
    {
        $database = Factory::createDatabaseWrapper();
        $model = Factory::buildObject('NewMachineProcessModel');

        $model->setDatabaseHandle($database);
        $model->getCreatedMachineResult();

        $model->setValidatedInput($validated_input);
        $model->storeNewMachineDetails();
        $register_new_machine_results = $model->getCreatedMachineResult();
        return $register_new_machine_results;
    }

    private function createView($register_new_machine_result)
    {
        $view = Factory::buildObject('NewMachineProcessView');

        $view->setStoreNewMachineDetailsResult($register_new_machine_result);
        $view->createOutputPage();
        $html_output = $view->getHtmlOutput();

        return $html_output;
    }
}