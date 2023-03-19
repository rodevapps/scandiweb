<?php

namespace Scandiweb\Databases;

class SqliteDatabase extends Database
{
    public function __construct()
    {
        try {
            $this->connection = new SQLite3(PROJECT_ROOT_PATH . '/databases/' . DB_FILE);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }			
    }

    public function query($query)
    {
        try {
            $result = $this->connection->query($query);

            return $result->fetchArray();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return [];
    }

    public function seed() {
        $this->connection->exec('DROP TABLE IF EXISTS product;');

        $this->connection->exec('CREATE TABLE product (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            sku TEXT NOT NULL UNIQUE,
            name TEXT NOT NULL,
            price REAL NOT NULL,
            product_type TEXT NOT NULL,
            size REAL DEFAULT NULL,
            weight REAL DEFAULT NULL,
            height REAL DEFAULT NULL,
            width REAL DEFAULT NULL,
            length REAL DEFAULT NULL
        );');

        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('aaa', 'Product 1', '10.00', 'dvd', '1500', NULL, NULL, NULL, NULL);");
        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('bbb', 'Product 2', '200.00', 'furniture', NULL, NULL, '122', '37.5', '154.1');");
        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('ccc', 'Product 3', '50.60', 'book', NULL, '1.36', NULL, NULL, NULL);");
        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('ddd', 'Product 4', '20.05', 'dvd', '900', NULL, NULL, NULL, NULL);");
        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('eee', 'Product 5', '400.00', 'furniture', NULL, NULL, '554', '77.5', '334.1');");
        $this->connection->exec("INSERT INTO product (sku, name, price, product_type, size, weight, height, width, length) VALUES ('fff', 'Product 6', '70.60', 'book', NULL, '0.9', NULL, NULL, NULL);");

        $result = $this->connection->query('SELECT * FROM product;');

        var_dump($result->fetchArray());
    }
}