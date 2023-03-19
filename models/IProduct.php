<?php

namespace Scandiweb\Models;

interface IProduct
{
    public function getProducts();

    public function deleteProducts(array $products);
}