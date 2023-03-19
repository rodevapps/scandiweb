<?php

require __DIR__ . "/configs/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode('/', $uri);

if (isset($uri[1]) && $uri[1] != '') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

header("Access-Control-Allow-Origin: *");

//print_r($uri);

use Scandiweb\Controllers\ProductController;

$controller = new ProductController();

$controller->index();

?>