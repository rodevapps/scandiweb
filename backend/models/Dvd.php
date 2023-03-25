<?php

namespace Scandiweb\Models;

class Dvd extends Product
{
    private readonly float $_size;

    public function addProduct() {
        return $this->_db->exec('INSERT INTO products ("sku", "name", "price", "product_type", "size") VALUES ("' . $this->getSKU() . '", "' . $this->getName() . '", "' . $this->getPrice() . '", "dvd", "' . $this->getSize() . '")');
    }

    public function getSize() {
        return $this->_size;
    }

    public function setSize(string $size) {
        $this->_size = $size;
    }
}