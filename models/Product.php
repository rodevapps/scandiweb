<?php

namespace Scandiweb\Models;

class Product implements IProduct
{
    protected readonly string $_sku;
    protected readonly string $_name;
    protected readonly float $_price;
    protected readonly string $_description;

    public function __construct(protected readonly IDatabase $_db) {}

    public function getProducts() {
        $_db->query('SELECT * FROM products');
    }

    public function deleteProducts(array $products) {
        $_db->query('DELETE FROM products WHERE id IN ()');
    }
}