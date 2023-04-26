<?php

namespace App\Http\Controllers\API\V1;

use App\Services\CandidateServiceInterface;
use App\Http\Requests\CreateCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
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

    /**
     * getCandidateDetail
     *
     * @param int $candidateId
     * @return json
     */
    public function getCandidateDetail(int $candidateId)
    {
        list($statusCode, $data) = $this->candidateService->getCandidateDetail($candidateId);

        return $this->response($data, $statusCode);
    }

    /**
     * updateCandidate
     *
     * @param UpdateCandidateRequest $request
     * @return json
     */
    public function updateCandidate(UpdateCandidateRequest $request)
    {
        $params = $request->all();
        $params['id'] = $request->id;
        list($statusCode, $data) = $this->candidateService->updateCandidate($params);

        return $this->response($data, $statusCode);
    }

    /**
     * getCandidateApplicationList
     *
     * @param int $candidateId
     * @return json
     */
    public function getCandidateApplicationList(int $candidateId)
    {
        list($statusCode, $data) = $this->candidateService->getCandidateApplicationList($candidateId);

        return $this->response($data, $statusCode);
    }

    /**
     * deleteCandidate
     *
     * @param int $candidateId
     * @return json
     */
    public function deleteCandidate(int $candidateId)
    {
        list($statusCode, $data) = $this->candidateService->deleteCandidate($candidateId);

        return $this->response($data, $statusCode);
    }
}
