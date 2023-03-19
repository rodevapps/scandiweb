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
            $result = $this->connection->query($query, MYSQLI_USE_RESULT);
    
            $res = [];

            while ($row = $result->fetch_array()) {
                $r = [];

                foreach($row as $k => $v) {
                    if (!is_numeric($k)) {
                        $res[$k] = $v;
                    }
                }

                $res[] = $r;
            }
    
            return $res;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return [];
    }

    public function generate() {
        $this->drop();

        $this->connection->exec('CREATE TABLE product (
            id INTEGER AUTO_INCREMENT,
            sku VARCHAR(255) NOT NULL,
            name TEXT NOT NULL,
            price FLOAT NOT NULL,
            product_type VARCHAR(100) NOT NULL,
            size FLOAT DEFAULT NULL,
            weight FLOAT DEFAULT NULL,
            height FLOAT DEFAULT NULL,
            width FLOAT DEFAULT NULL,
            length FLOAT DEFAULT NULL,
            PRIMARY KEY ( id ),
            UNIQUE KEY ( sku )
        );');

        $this->populate();
    }
}