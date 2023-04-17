<?php

namespace App\Services;

interface AuthServiceInterface
{
    public function login($params);

    public function logout();
}
