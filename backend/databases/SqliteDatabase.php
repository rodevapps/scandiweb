<?php

namespace Scandiweb\Databases;

class SqliteDatabase extends Database
{
    public function __construct()
    {
        try {
            $this->_connection = new \SQLite3(PROJECT_ROOT_PATH . '/databases/' . DB_FILE);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function query($query)
    {
        try {
            $result = $this->_connection->query($query);

            if ($result->numColumns()) {
                $res = [];

                while ($row = $result->fetchArray()) {
                    $r = [];
    
                    foreach($row as $k => $v) {
                        if (!is_numeric($k)) {
                            $r[$k] = $v;
                        }
                    }
    
                    $res[] = $r;
                }

                return $res;
            } else {
                return true;
            }
        } catch(Exception $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }

    public function generate() {
        try {
            $this->drop();

            $this->query('CREATE TABLE products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                sku VARCHAR(255) NOT NULL UNIQUE,
                name TEXT NOT NULL,
                price FLOAT NOT NULL,
                product_type VARCHAR(100) NOT NULL,
                size FLOAT DEFAULT NULL,
                weight FLOAT DEFAULT NULL,
                height FLOAT DEFAULT NULL,
                width FLOAT DEFAULT NULL,
                length FLOAT DEFAULT NULL
            );');

            $this->seed();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
