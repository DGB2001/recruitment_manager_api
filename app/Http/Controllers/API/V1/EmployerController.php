<?php

namespace App\Http\Controllers\API\V1;

use App\Services\EmployerServiceInterface;
use App\Http\Requests\CreateEmployerRequest;
use App\Http\Requests\GetEmployerListRequest;
use App\Http\Requests\UpdateEmployerRequest;
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

    /**
     * updateEmployer
     *
     * @param UpdateEmployerRequest $request
     * @return json
     */
    public function updateEmployer(UpdateEmployerRequest $request)
    {
        $params = $request->all();
        $params['id'] = $request->id;
        list($statusCode, $data) = $this->employerService->updateEmployer($params);

        return $this->response($data, $statusCode);
    }

    /**
     * getEmployerList
     *
     * @param GetEmployerListRequest $request
     * @return json
     */
    public function getEmployerList(GetEmployerListRequest $request)
    {
        list($statusCode, $data) = $this->employerService->getEmployerList($request->all());

        return $this->response($data, $statusCode);
    }
}
