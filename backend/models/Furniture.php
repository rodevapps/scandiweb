<?php

namespace Scandiweb\Models;

class Furniture extends Product
{
    private readonly float $_height;
    private readonly float $_width;
    private readonly float $_length;

    public function addProduct() {
        return $this->_db->exec('INSERT INTO products (sku, name, price, product_type, height, width, length) VALUES ("' . $this->getSKU() . '", "' . $this->getName() . '", "' . $this->getPrice() . '", "furniture", "' . $this->getHeight() . '", "' . $this->getWidth() . '", "' . $this->getLength() . '")');
    }

    public function getHeight() {
        return $this->_height;
    }

    public function setHeight(string $height) {
        $this->_height = $height;
    }

    public function getWidth() {
        return $this->_width;
    }

    public function setWidth(string $width) {
        $this->_width = $width;
    }

    public function getLength() {
        return $this->_length;
    }

    public function setLength(string $length) {
        $this->_length = $length;
    }
}
