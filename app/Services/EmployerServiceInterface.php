<?php

namespace App\Services;

interface EmployerServiceInterface
{
    public function createEmployer(array $params);

    public function getEmployerDetail(int $employerId);

    public function updateEmployer(array $params);

    public function getEmployerList(array $params);
}
