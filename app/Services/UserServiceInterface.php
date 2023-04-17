<?php

namespace App\Services;

interface UserServiceInterface
{
    public function getUser();

    public function addUser($params);

    public function updateUser($params);

    public function deleteUser($params);
}
