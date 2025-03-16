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
    case 'add-user':
        $controller->showAddUser();
        break;
    case 'save-user':
        if ($method == 'POST') {
            $controller->saveUser();
            break;
        }
    case 'edit-user':
        if (isset($urlParts[1]) && is_numeric((int) $urlParts[2])) {
            if ($method === 'GET') {
                $controller->showEditUser($urlParts[2]);
            } elseif ($method === 'POST') {
                $controller->editUser($urlParts[2]);
            }
            break;
        }
    case 'delete':
        if (isset($urlParts[1]) && is_numeric((int) $urlParts[2])) {
            $controller->deleteUser($urlParts[2]);
        }

    default:
        http_response_code(404);
        echo "404 Not Found!";
        break;
}

?>