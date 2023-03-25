<?php

namespace Scandiweb\Models;

use Scandiweb\Databases\IDatabase;
use Scandiweb\Databases\SqliteDatabase;

class Product implements IProduct
{
    protected readonly IDatabase $_db;
    protected readonly string $_sku;
    protected readonly string $_name;
    protected readonly float $_price;

    public function __construct() {
        if (DB_TYPE === "sqlite") {
            $this->_db = new SqliteDatabase();
        } else {
            $this->_db = new MysqlDatabase();
        }
    }

    public function getProducts() {
        return $this->_db->query('SELECT * FROM products');
    }

    public function deleteProducts(array $idx) {
        return $this->_db->exec('DELETE FROM products WHERE id IN (' . implode(", ", $idx) . ')');
    }

    public function getSKU() {
        return $this->_sku;
    }

    public function setSKU(string $sku) {
        $this->_sku = $sku;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName(string $name) {
        $this->_name = $name;
    }

    public function getPrice() {
        return $this->_price;
    }

    public function setPrice(int $price) {
        $this->_price = $price;
    }
}