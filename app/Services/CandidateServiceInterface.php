<?php

namespace App\Services;

interface CandidateServiceInterface
{
    public function createCandidate(array $params);

    public function getCandidateDetail(int $candidateId);
}
