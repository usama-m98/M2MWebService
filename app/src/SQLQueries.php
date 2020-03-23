<?php


namespace Coursework;


/**
 * class used to run sql queries on the slim bob to allow,
message data to be retrieved and inserted
*/
class SQLQueries
{
    public function __construct() {}

    public function __destruct() {}

    /**
this function is used to retrieve message data from the database,
through the use of an sql query
*/
    public function getMessageData()
    {
        $query_string = "SELECT board_id, msisdn, name, date, switch1, switch2,";
        $query_string .= " switch3, switch4, fan, temperature, keypad";
        $query_string .= " FROM board_status";
        return $query_string;
    }
    /**
    function used ro run sql query to allow the insertion of message data
    */
    public function insertMessageData()
    {
        $query_string = "INSERT INTO board_status";
        $query_string .= " SET ";
        $query_string .= "msisdn = :msisdn, ";
        $query_string .= "name = :team_name, ";
        $query_string .= "date = :timestamp, ";
        $query_string .= "switch1 = :switch1, ";
        $query_string .= "switch2 = :switch2, ";
        $query_string .= "switch3 = :switch3, ";
        $query_string .= "switch4 = :switch4, ";
        $query_string .= "fan = :fan_state, ";
        $query_string .= "temperature = :heater_temp, ";
        $query_string .= "keypad = :keypad";

        return $query_string;
    }

}