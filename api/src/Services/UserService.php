<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function createUser($first_name, $last_name, $email)
    {
        return $this->userRepository->createUser($first_name, $last_name, $email);
    }
}