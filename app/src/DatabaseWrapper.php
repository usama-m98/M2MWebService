<?php


namespace Coursework;
use PDO;

/**
class is used to connect to the database and does,
the database queries.
*/
class DatabaseWrapper
{
    private $database_connection_settings;
    private $db_handle;
    private $sql_queries;
    private $prepared_statement;
    private $errors;

    public function __construct()
    {
        $this->database_connection_settings = null;
        $this->db_handle = null;
        $this->sql_queries = null;
        $this->prepared_statement = null;
        $this->errors = [];
    }

    public function __destruct() { }

    /**
    function is used to set the database connection settings prior,
    to connection to the database.
    */
    public function setDatabaseConnectionSettings($database_connection_settings)
    {
        $this->database_connection_settings = $database_connection_settings;
    }

    /**
function is used to connect to the database
*/
    public function connectToDatabase()
    {
        $pdo = false;
        $pdo_error = '';

        $database_settings = $this->database_connection_settings;
        $host_name = $database_settings['rdbms'] . ':host=' . $database_settings['host'];
        $port_number = ';port=' . '3306';
        $user_database = ';dbname=' . $database_settings['db_name'];
        $host_details = $host_name . $port_number . $user_database;
        $user_name = $database_settings['user_name'];
        $user_password = $database_settings['user_password'];
        $pdo_attributes = $database_settings['options'];

        try
        {
            $pdo_handle = new \PDO($host_details, $user_name, $user_password, $pdo_attributes);
            $this->db_handle = $pdo_handle;
        }
        catch (\PDOException $exception_object)
        {
            trigger_error('error connecting to database');
            $pdo_error = 'error connecting to database';
        }

        return $pdo_error;
    }

    /**
     * function used to set sql query.
     * @param $sql_queries
     */
    public function setSqlQueries($sql_queries)
    {
        $this->sql_queries = $sql_queries;
    }

    /**
     * function used to store database values
     * @param $cleaned_parameters
     */
    public function storeDatabaseValues($cleaned_parameters)
    {
        $query = $this->sql_queries->insertMessageData();

        $parameters =
            [
                ':msisdn' => $cleaned_parameters['msisdn'],
                ':team_name' => $cleaned_parameters['team_name'],
                ':timestamp' => $cleaned_parameters['received_time'],
                ':switch1' => $cleaned_parameters['switch_1'],
                ':switch2' => $cleaned_parameters['switch_2'],
                ':switch3' => $cleaned_parameters['switch_3'],
                ':switch4' => $cleaned_parameters['switch_4'],
                ':fan_state' => $cleaned_parameters['fan_state'],
                ':heater_temp' => $cleaned_parameters['heater_temperature'],
                ':keypad' => $cleaned_parameters['keypad']
            ];

        $this->safeQuery($query, $parameters);
    }

    /**
     * Returns the values stored in the database
     */
    public function getDatabaseValues()
    {
        $query = $this->sql_queries->getMessageData();
        $this->safeQuery($query);
    }

    /**
     *Safely executes an sql query.
     */
    private function safeQuery($query_string, $params = null)
    {
        $this->errors['db_error'] = false;
        $query_parameters = $params;
        try
        {
            $this->prepared_statement = $this->db_handle->prepare($query_string);
            $execute_result = $this->prepared_statement->execute($query_parameters);
            $this->errors['execute-OK'] = $execute_result;
        }
        catch (PDOException $exception_object)
        {
            $error_message  = 'PDO Exception caught. ';
            $error_message .= 'Error with the database access.' . "\n";
            $error_message .= 'SQL query: ' . $query_string . "\n";
            $error_message .= 'Error: ' . var_dump($this->prepared_statement->errorInfo(), true) . "\n";
            // NB would usually log to file for sysadmin attention
            $this->errors['db_error'] = true;
            $this->errors['sql_error'] = $error_message;
        }
        return $this->errors['db_error'];
    }

    public function countRows()
    {
        $num_rows = $this->prepared_statement->rowCount();
        return $num_rows;
    }

    public function safeFetchRow()
    {
        $record_set = $this->prepared_statement->fetch(PDO::FETCH_NUM);
        return $record_set;
    }

    public function safeFetchArray()
    {
        $row = $this->prepared_statement->fetch(PDO::FETCH_ASSOC);
        $this->prepared_statement->closeCursor();
        return $row;
    }

    public function safeFetchAll()
    {
        $row = $this->prepared_statement->fetchAll();
        return $row;
    }
}