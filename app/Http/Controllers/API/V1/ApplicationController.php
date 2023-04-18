<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\CreateApplicationRequest;
use App\Services\ApplicationServiceInterface;
use Illuminate\Http\Request;

class ApplicationController extends BaseController
{
    protected $applicationService;

    /**
     * Create a new instance
     *
     * @param ApplicationServiceInterface $applicationService
     */
    public function __construct(ApplicationServiceInterface $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * createApplication
     *
     * @param Request $request
     * @return json
     */
    public function createApplication(CreateApplicationRequest $request)
    {
        list($statusCode, $data) = $this->applicationService->createApplication($request->all());

        return $this->response($data, $statusCode);
    }
}
