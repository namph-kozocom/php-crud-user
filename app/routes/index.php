<?php
namespace App\Routes;

use App\Controllers\UserController;


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlParts = explode('/', $uri);
$method = $_SERVER['REQUEST_METHOD'];
$controller = new UserController();

switch ($urlParts[1]) {
    case '':
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "404 Not Found!";
        break;
}

?>