<?php

namespace Scandiweb\Models;

class Book extends Product
{
    private readonly float $_weight;

    public function addProduct() {
        return $this->_db->exec('INSERT INTO products (sku, name, price, product_type, weight) VALUES ("' . $this->getSKU() . '", "' . $this->getName() . '", "' . $this->getPrice() . '", "dvd", "' . $this->getWeight() . '")');
    }

    public function getWeight() {
        return $this->_weight;
    }

    public function setWeight(string $weight) {
        $this->_weight = $weight;
    }
}
