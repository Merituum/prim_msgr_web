<?php

class Database {
    private $host_name = "localhost";
    private $login = "root";
    private $password = "";
    private $database = "prim_msgr";
    public $connection;
    #constructor as connection function
    public function __construct()
    {
        $this->connection = new mysqli($this->host_name, $this->login, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public function query_sql($sql) {
        return $this->connection->query($sql);
    }
    #protection from sql injection
    public function escapeString($string) {
        return $this->connection->real_escape_string($string);

    }
    #close connection function
    public function close_connection_db(){
        $this->connection->close();
    }
}