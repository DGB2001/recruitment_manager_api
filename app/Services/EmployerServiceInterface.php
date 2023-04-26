<?php

namespace App\Services;

interface EmployerServiceInterface
{
    public function createEmployer(array $params);

    public function getEmployerDetail(int $employerId);
}
