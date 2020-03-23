<?php

namespace Coursework;

/**
 * class is used as a vaildator and sanitiser for any messages
 * recieved and downloading
 */
class ValidateMessage
{

    public function __construct(){}

    public function __destruct(){}


    /**
     * function is used to vaildate the state of the switch by checking
     * for expected results.
     */
    //using options to validate this as their is only two possible options
    public function validateSwitch($switch_to_check)
    {
        $checked_options = false;
        $expected_values = [
            'On' => 'On',
            'Off' => 'Off',
        ];

        $result = array_key_exists($switch_to_check, $expected_values);

        if ($result === true)
        {
            $checked_options = $expected_values[$switch_to_check];
        }

        return $checked_options;
    }

    /**
     * validates the state of the fan  by checking if fan state has been entered
     * and if its one of the expected values.
*/
    public function validateFan($fan_state)
    {
        $checked_state = false;
        $expected_values = [
            'Forward' => 'Forward',
            'Reverse' => 'Reverse',
        ];

        $result = array_key_exists($fan_state, $expected_values);

        if ($result===true)
        {
            $checked_state = $expected_values[$fan_state];
        }

        return $checked_state;
    }

    /**
     * sanitises and vaildates the temperature entered and returns vaild temperature.
*/
    public function validateTemperature($temperature_to_check)
    {
        $checked_temp = false;
        $minimum_temp = -273.15;

        if ($temperature_to_check === ''){
            $temperature_to_check = 0;
        }

        if (isset($temperature_to_check))
        {
            $sanitised_temp = filter_var($temperature_to_check, FILTER_SANITIZE_NUMBER_FLOAT);
            $validated_temp = filter_var($sanitised_temp, FILTER_VALIDATE_FLOAT);

            if ($validated_temp >= $minimum_temp)
            {
                $checked_temp = $validated_temp;
            }
        }

        return $checked_temp;
    }
    /**
     * function takes number entered and sanitises and vaildates before,
     * checking it against min and max number.
     */
    public function validateNumberEntered($number_to_check)
    {
        $checked_number = false;

        if ($number_to_check === '')
        {
            $number_to_check = 0;
        }

        if (isset($number_to_check))
        {
            $min_number = 0;
            $max_number = 9;

            $sanitised_number = filter_var($number_to_check, FILTER_SANITIZE_NUMBER_INT);
            $validated_number = filter_var($sanitised_number, FILTER_VALIDATE_INT);

            if ($validated_number >= 0 && $validated_number <= 9)
            {
                $checked_number = $validated_number;
            }
        }

        return $checked_number;
    }

    /**
     * function used to sanitise and validate the meta data
     */
    public function validateMetaData($meta_data)
    {
        $checked_data = false;
        $unclean_data = $meta_data;

        if (isset($meta_data))
        {
            $sanitised_data = filter_var($unclean_data, FILTER_SANITIZE_STRING);
            $checked_data = $sanitised_data;
        }

        return $checked_data;
    }

    /**
     * function used to sanitise and validate the msisdn entered returns
     * a sanitised version of data
       */
    public function validateMsisdn($msisdn)
    {
        $checked_number = false;

        if (isset($msisdn))
        {
            $sanitised_number = filter_var($msisdn, FILTER_SANITIZE_NUMBER_INT);
            $validated_number = filter_var($sanitised_number, FILTER_VALIDATE_INT);

            $checked_number = $validated_number;
        }

        return $checked_number;
    }

    /**
     * function used to sanitise and validate the date entered
     * and makes sure it is in the correct format, returns a validated,
     * version of date
     */
    public function validateDateTime($date_time)
    {
        $checked_data_time = false;

        if (strtotime($date_time))
        {
            $checked_data_time = $date_time;
        }

        return $checked_data_time;
    }
}