<?php

namespace App\Services;

use App\Models\Application;
use Illuminate\Support\Facades\DB;
use App\Models\RecruitmentNews;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApplicationService implements ApplicationServiceInterface
{
    /**
     * createApplication
     *
     * @return array
     */
    public function createApplication($params)
    {
        DB::beginTransaction();
        try {
            Application::create($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            \Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('auth.failed')]]];
        }
        return [Response::HTTP_CREATED, []];
    }
}
