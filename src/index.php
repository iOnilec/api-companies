<?php

use App\Controllers\CompaniesController\CompaniesController;

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/Controllers/CompaniesController.php';


$controller = new CompaniesController();

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// remover as querys strings se existir
$uri = explode('?', $uri, 2)[0];

// roteamento
if ($uri === '/companies' && $method === 'GET') {
    $controller->index();
} elseif (preg_match('/\/companies\/(\d+)/', $uri, $matches)) {

    $id = $matches[1];

    if ($method === 'GET') {
        $controller->show($id);
    } elseif ($method === 'PUT') {
        $controller->update($id);
    } elseif ($method === 'DELETE') {
        $controller->destroy($id);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
    }
} elseif ($uri === '/companies' && $method === 'POST') {
    $controller->store();
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Rota não encontrada']);
}