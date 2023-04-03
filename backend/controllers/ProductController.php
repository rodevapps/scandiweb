<?php

namespace Scandiweb\Controllers;

use Scandiweb\Models\Dvd;
use Scandiweb\Models\Book;
use Scandiweb\Models\Product;
use Scandiweb\Models\Furniture;

class ProductController extends BaseController
{
    public function index()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $product = new Product();

                $products = $product->getProducts();

                $responseData = json_encode($products);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if (strtoupper($requestMethod) == 'POST') {
            try {
                $content = trim(file_get_contents("php://input"));
                $data = json_decode($content, true);

                if ($data["type"] === "dvd") {
                    $product = new Dvd();
                    $product->setSize($data['size']);
                } else if ($data["type"] === "furniture") {
                    $product = new Furniture();
                    $product->setWidth($data['width']);
                    $product->setHeight($data['height']);
                    $product->setLength($data['length']);
                } else if ($data["type"] === "book") {
                    $product = new Book();
                    $product->setWeight($data['weight']);
                }

                if ($data["type"] === "dvd" || $data["type"] === "furniture" || $data["type"] === "book") {
                    $product->setSKU($data['sku']);
                    $product->setName($data['name']);
                    $product->setPrice($data['price']);
                    $product = $product->addProduct();
                    $responseData = json_encode($product);
                } else {
                    $responseData = json_encode([['status', 'error'], ['message', "Product type {$data['type']} not found!"]]);
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if (strtoupper($requestMethod) == 'DELETE') {
            try {
                $content = trim(file_get_contents("php://input"));
                $data = json_decode($content, true);

                $product = new Product();
                $products = $product->deleteProducts($data);

                $responseData = json_encode($products);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage();
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else if (strtoupper($requestMethod) == 'OPTIONS') {
            $responseData = json_encode([['status', 'ok'], ['message', "OK"]]);
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
