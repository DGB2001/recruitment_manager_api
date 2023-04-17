<?php

namespace App\Http\Controllers\API\V1;

use App\Services\AuthServiceInterface;
use App\Http\Requests\LoginRequest;

class AuthController extends BaseController
{
    protected $authService;

    /**
     * Create a new instance
     *
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Post login API-LG-010
     *
     * @param LoginRequest $request
     * @return json
     */
    public function login(LoginRequest $request)
    {
        list($statusCode, $data) = $this->authService->login($request);

        return $this->response($data, $statusCode);
    }

    public function logout()
    {
        list($statusCode, $data) = $this->authService->logout();

        return $this->response($data, $statusCode);
    }
}
