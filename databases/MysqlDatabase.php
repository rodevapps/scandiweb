<?php

namespace Scandiweb\Databases;

class MysqlDatabase extends Database
{
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
    	
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function query($query)
    {
        try {
            return $this->connection->query($query, MYSQLI_USE_RESULT);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return false;
    }
}