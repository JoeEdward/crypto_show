<?php


class NewMachineProcessModel extends ModelAbstract
{
    private $create_machine_result;
    private $validated_machine_result;

    public function __construct()
    {
        parent::__construct();
        $this->create_machine_result = [];
        $this->validated_machine_result = "";
    }

    public function __destruct()
    {
    }

    public function setDatabaseHandle($database_handle)
    {
        $this->database_handle = $database_handle;
    }

    public function setValidatedInput($validated_input)
    {
        $this->validated_machine_result = $validated_input;
    }

    public function getCreatedMachineResult() {
        return $this->create_machine_result;
    }

    public function storeNewMachineDetails() {
        $new_machine_details_stored = false;
        $sql_query = SqlQuery::queryStoreNewMachineDetails();
        $sql_options = array(
            ':userid' => $_SESSION['user-id'],
            ':name' => $this->validated_machine_result['validated-machine-name'],
            ':image' => $this->validated_machine_result['validated-machine-image'],
            ':private' => 0
        );

        try {
            $query_result = $this->database_handle->safeQuery($sql_query, $sql_options);
        } catch (Exception $e) {
            var_dump('Caught exception: ',  $e->getMessage(), "\n");
        }

        $rows_inserted = $this->database_handle->countRows();

        if ($rows_inserted == 1)
        {
            $new_user_details_stored = true;
        }
        $this->create_machine_result = $this->validated_machine_result;
        $this->create_machine_result['store-new-user-details-result'] = $new_machine_details_stored;
    }
}