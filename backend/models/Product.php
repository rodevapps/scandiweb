<?php

namespace Scandiweb\Models;

use Scandiweb\Databases\IDatabase;

class Product implements IProduct
{
    protected readonly string $_sku;
    protected readonly string $_name;
    protected readonly float $_price;
    protected readonly string $_description;

    public function __construct(protected readonly IDatabase $_db) {}

    public function getProducts() {
        return $this->_db->query('SELECT * FROM products');
    }

    public function deleteProducts(array $idx) {
        return $this->_db->query('DELETE FROM products WHERE id IN (' . implode(", ", $idx) . ')');
    }
}