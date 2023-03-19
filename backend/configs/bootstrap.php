<?php

define("PROJECT_ROOT_PATH", __DIR__ . "/../");

require_once PROJECT_ROOT_PATH . "/configs/config.php";

require_once PROJECT_ROOT_PATH . '/databases/IDatabase.php';
require_once PROJECT_ROOT_PATH . '/databases/Database.php';
require_once PROJECT_ROOT_PATH . '/databases/SqliteDatabase.php';
require_once PROJECT_ROOT_PATH . '/databases/MysqlDatabase.php';

require_once PROJECT_ROOT_PATH . '/models/IProduct.php';
require_once PROJECT_ROOT_PATH . '/models/Product.php';

require_once PROJECT_ROOT_PATH . '/controllers/BaseController.php';
require_once PROJECT_ROOT_PATH . "/controllers/ProductController.php";

?>