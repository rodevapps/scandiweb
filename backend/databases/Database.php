<?php

namespace Scandiweb\Databases;

abstract class Database implements IDatabase
{
    protected mixed $_connection;

    abstract public function query($query);
    abstract public function generate();

    protected function drop() {
        try {
            $this->_connection->exec('DROP TABLE IF EXISTS products;');
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected function seed() {
        try {
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('aaa', 'Product 1', '10.00', 'dvd', '1500', NULL, NULL, NULL, NULL);");
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('bbb', 'Product 2', '200.00', 'furniture', NULL, NULL, '122', '37.5', '154.1');");
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('ccc', 'Product 3', '50.60', 'book', NULL, '1.36', NULL, NULL, NULL);");
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('ddd', 'Product 4', '20.05', 'dvd', '900', NULL, NULL, NULL, NULL);");
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('eee', 'Product 5', '400.00', 'furniture', NULL, NULL, '554', '77.5', '334.1');");
            $this->_connection->exec("INSERT INTO products (sku, name, price, product_type, size, weight, height, width, length) VALUES ('fff', 'Product 6', '70.60', 'book', NULL, '0.9', NULL, NULL, NULL);");
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }            
    }

    public function exec($query) {
        try {
            $res = $this->_connection->exec($query);

            return ["status" => "success", "message" => '"' . ($res === true ? 'Query executed correctly' : $res) . '"'];
        } catch(Exception $e) {
            return '["status" => "error", "message" => "' . $e->getMessage() . '"]';
        }
    }
}