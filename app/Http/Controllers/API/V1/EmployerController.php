<?php

namespace App\Http\Controllers\API\V1;

use App\Services\EmployerServiceInterface;
use App\Http\Requests\CreateEmployerRequest;
use Illuminate\Http\Request;

class EmployerController extends BaseController
{
    protected $employerService;

    /**
     * Create a new instance
     *
     * @param EmployerServiceInterface $employerService
     */
    public function __construct(EmployerServiceInterface $employerService)
    {
        $this->employerService = $employerService;
    }

    /**
     * createCandidate
     *
     * @param CreateEmployerRequest $request
     * @return json
     */
    public function createEmployer(CreateEmployerRequest $request)
    {
        list($statusCode, $data) = $this->employerService->createEmployer($request->all());

        return $this->response($data, $statusCode);
    }

    /**
     * getEmployerDetail
     *
     * @param int $employerId
     * @return json
     */
    public function getEmployerDetail(int $employerId)
    {
        list($statusCode, $data) = $this->employerService->getEmployerDetail($employerId);

        return $this->response($data, $statusCode);
    }
}
