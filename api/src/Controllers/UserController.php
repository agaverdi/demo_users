<?php

namespace App\Controllers;

use App\Services\UserService;


class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function listUsers()
    {
        echo json_encode($this->userService->getAllUsers());
    }

    public function createUser()
    {
        $data = $_POST;

        if (isset($data['first_name']) && isset($data['last_name']) && isset($data['email'])) {
            $user = $this->userService->createUser($data['first_name'], $data['last_name'], $data['email']);
            echo json_encode($user);
        } else {
            header("Bad Request");
            echo json_encode(['message' => 'Invalid input']);
        }
    }
}