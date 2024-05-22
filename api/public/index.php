<?php

require '../vendor/autoload.php';

use App\Controllers\UserController;
use App\Repositories\UserRepository;
use App\Services\UserService;

$config = require '../config/config.php';

$userRepository = new UserRepository($config['mysql']);
$userService = new UserService($userRepository);
$userController = new UserController($userService);

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === 'MY_LOCALHOST PATH /public/users' && $requestMethod === 'GET') {
    $userController->listUsers();
} elseif ($requestUri === 'MY_LOCALHOST PATH /public/users' && $requestMethod === 'POST') {
    $userController->createUser();
} else {
    header("Not Found");
    echo json_encode(['message' => 'Path tapilmadi']);
}