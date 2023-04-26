<?php

namespace App\Services;

use App\Models\Employer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class EmployerService implements EmployerServiceInterface
{
    /**
     * createEmployer
     *
     * @return array
     */
    public function createEmployer($params)
    {
        $params['user_id'] = 1;
        DB::beginTransaction();
        try {
            $params['password'] = bcrypt($params['password']);
            $user = User::create($params);
            $params['user_id'] = $user->id;
            Employer::create($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }
        return [Response::HTTP_CREATED, ['status' => Response::HTTP_CREATED]];
    }

    /**
     * getEmployerDetail
     *
     * @param int $employerId
     * @return array
     */
    public function getEmployerDetail(int $employerId)
    {
        $candidate = Employer::with(['user'])->findOrFail($employerId);
        return [Response::HTTP_OK, $candidate];
    }
}
