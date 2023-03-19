<?php

namespace Scandiweb\Controllers;

use Scandiweb\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $product = new Product(new SqliteDatabase());

                $products = $product->getProducts();

                $responseData = json_encode($products);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if (strtoupper($requestMethod) == 'POST') {
            try {
                $product = new Product();

                $products = $product->addProduct();

                $responseData = json_encode($products);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if (strtoupper($requestMethod) == 'DELETE') {
            try {
                $product = new Product();

                $products = $product->deleteProducts();

                $responseData = json_encode($products);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->output($responseData, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } else {
            $this->output(json_encode(array('error' => $strErrorDesc)), array('Content-Type: application/json', $strErrorHeader));
        }
    }
}