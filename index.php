<?php

require_once __DIR__ . '/vendor/autoload.php';

use Jorgeaguero\Docfav\Entity\User\Infrastructure\Controller\UserController;

header('Content-Type: application/json');

$userController = new UserController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $userController->registerUser($_POST);
    if ($response->result() === false) {
        header("HTTP/1.1 500 Internal Server Error");
    }

    echo $response->toJson();
} else {
    echo json_encode(['message' => 'Method not allowed']);
}
