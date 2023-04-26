<?php

namespace App\Services;

interface CandidateServiceInterface
{
    public function createCandidate(array $params);

    public function getCandidateDetail(int $candidateId);

    public function updateCandidate(array $params);

    public function getCandidateApplicationList(int $candidateId);

    public function deleteCandidate(int $candidateId);
}
