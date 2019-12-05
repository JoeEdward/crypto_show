<?php
/**
 * Validate.php PHP program to perform simple calculations
 *
 * class to validate & sanitise the user entered values
 * returns an error flag if there was a problem
 *
 * NB the values entered by the user are passed as an array
 *
 * @author CF Ingrams - cfi@dmu.ac.uk
 * @copyright De Montfort University
 *
 * @package simple_sums
 */

class Validate
{
    public function __construct() {}

    public function __destruct() {}

    /**
     * Check that the route name from the browser is a valid route
     * If it is not, abandon the processing.
     * NB this is not a good way to achieve this error handling.
     *
     * @param $route
     * @return boolean
     */
    public function validateRoute($route)
    {
        $route_exists = false;
        $routes = [
            'index',
            'user_register',
            'process_new_user_details',
            'user_login',
            'process_login',
            'user_logout',
            'create-new-machine',
            'process-new-machine',
            'display-crypto-details'
        ];

        if (in_array($route, $routes))
        {
            $route_exists =  true;
        }
        else
        {
            die();
        }
        return $route_exists;
    }

    /**
     * Tests that every character in the entered string is a digit.  If  returns false
     * @param $value
     * @return bool|int
     */
    public function validateInteger(int $value): int
    {
        $sanitised_integer = false;
        if (ctype_digit(($value)))
        {
            $sanitised_integer = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        }
        return $sanitised_integer;
    }

    public function validateString(string $datum_name, array $tainted, int $min_length, int $max_length)
    {
        $validated_string = false;
        if (!empty($tainted[$datum_name]))
        {
            $string_to_check = $tainted[$datum_name];
            $sanitised_string = filter_var($string_to_check, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $sanitised_string_length = strlen($sanitised_string);
            if ($min_length <= $sanitised_string_length && $sanitised_string_length <= $max_length)
            {
                $validated_string = $sanitised_string;
            }
        }
        return $validated_string;
    }

    public function validateEmail($datum_name, $tainted, $datum_name_confirm, $maximum_email_length)
    {
        $minimum_email_length = 0;
        $validated_email_to_return = false;

        if (!empty($tainted[$datum_name]) && !empty($tainted[$datum_name_confirm]))
        {
            $email_to_check = $tainted[$datum_name];
            $email_confirm_to_check = $tainted[$datum_name_confirm];

            $sanitised_email = filter_var($email_to_check, FILTER_SANITIZE_EMAIL);
            $validated_email = filter_var($sanitised_email, FILTER_VALIDATE_EMAIL);

            $validated_email_length = strlen($validated_email);
            if ($minimum_email_length <= $validated_email_length && $validated_email_length <= $maximum_email_length)
            {
                if (strcmp($validated_email, $email_confirm_to_check) == 0)
                {
                    $validated_email_to_return = $sanitised_email;
                }
            }
        }
        return $validated_email_to_return;
    }

    public function validateImage(string $datum_name, array $tainted, int $file_size) {
        $uploadOk = false;
        if(!empty($_FILES[$datum_name])){
            $uploadOk = true;
        }

        $target_file = 'media/crypto_machine_pics/' . basename($_FILES[$datum_name]['name']);
        $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = false;
        }
        if ($_FILES[$datum_name]["size"] > $file_size) {
            return "Sorry, your file is too large.";
            $uploadOk = false;
        }
        if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg"
            && $file_type != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = false;
        }

        if (!$uploadOk) {
            echo "Sorry, your file was not uploaded.";
            return $uploadOk;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$datum_name]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES[$datum_name]["name"]). " has been uploaded.";
                return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }

    }

    public function validateCheckbox(string $datum_name, $tainted) {
        if (!isset($tainted[$datum_name])) {
            return 'NO';
        } else {
            return 'YES';
        }
    }

    public function checkForError($cleaned)
    {
        $input_error = false;
        foreach ($cleaned as $field_to_check)
        {
            if ($field_to_check === false)
            {
                $input_error = true;
                break;
            }

        }
        return $input_error;
    }

}
