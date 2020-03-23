<?php


namespace Coursework;

/**
class acts a middle man between the database wrapper and view message data.
*/
class MessageDataModel
{
    private $database_wrapper;
    private $database_connection_settings;
    private $sql_queries;
    private $result;

    public function __construct(){}

    public function __destruct(){}

    public function setDatabaseWrapper($database_wrapper)
    {
        $this->database_wrapper = $database_wrapper;
    }

    public function setDatabaseConnectionSettings($database_connection_settings)
    {
        $this->database_connection_settings = $database_connection_settings;
    }

    public function setSqlQueries($sql_queries)
    {
        $this->sql_queries = $sql_queries;
    }

    public function storeMessage($cleaned_parameters)
    {
        $this->database_wrapper->setSqlQueries($this->sql_queries);
        $this->database_wrapper->setDatabaseConnectionSettings($this->database_connection_settings);
        $this->database_wrapper->connectToDatabase();
        $this->database_wrapper->storeDatabaseValues($cleaned_parameters);
    }

    public function getMessage()
    {
        $this->database_wrapper->setSqlQueries($this->sql_queries);
        $this->database_wrapper->setDatabaseConnectionSettings($this->database_connection_settings);
        $this->database_wrapper->connectToDatabase();
        $this->database_wrapper->getDatabaseValues();
        return $this->database_wrapper->safeFetchAll();
    }

}