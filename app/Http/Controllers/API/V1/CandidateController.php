<?php

namespace App\Http\Controllers\API\V1;

use App\Services\CandidateServiceInterface;
use App\Http\Requests\CreateCandidateRequest;
use Illuminate\Http\Request;

class CandidateController extends BaseController
{
    protected $candidateService;

    /**
     * Create a new instance
     *
     * @param CandidateServiceInterface $applicationService
     */
    public function __construct(CandidateServiceInterface $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * createCandidate
     *
     * @param CreateCandidateRequest $request
     * @return json
     */
    public function createCandidate(CreateCandidateRequest $request)
    {
        list($statusCode, $data) = $this->candidateService->createCandidate($request->all());

        return $this->response($data, $statusCode);
    }
}
