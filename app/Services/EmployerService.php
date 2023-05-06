<?php

namespace App\Services;

use App\Models\Employer;
use App\Models\RecruitmentNews;
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
        $employer = Employer::with(['user'])->findOrFail($employerId);
        return [Response::HTTP_OK, $employer];
    }

    /**
     * updateEmployer
     *
     * @param array $params
     * @return array
     */
    public function updateEmployer(array $params)
    {
        $employer = Employer::findOrFail($params['id']);
        $user = $employer->user;

        DB::beginTransaction();
        try {
            $user->update(['email' => $params['email']]);
            $employer->update($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }

        return [Response::HTTP_CREATED, ['status' => Response::HTTP_NO_CONTENT]];
    }

    /**
     * getEmployerList
     *
     * @param array $params
     * @return array
     */
    public function getEmployerList(array $params)
    {
        $queryGetEmployerList = Employer::orderBy('company_name', 'asc');

        if (isset($params['company_name'])) {
            $queryGetEmployerList = $queryGetEmployerList->where('company_name', 'like', '%' . $params['company_name'] . '%');
        }

        if (isset($params['address'])) {
            $queryGetEmployerList = $queryGetEmployerList->where('address', 'like', '%' . $params['address'] . '%');
        }

        $employerList = $queryGetEmployerList->get();
        return [Response::HTTP_OK, $employerList];
    }

    /**
     * getEmployerDetail
     *
     * @param int $employerId
     * @return array
     */
    public function deleteEmployer(int $employerId)
    {
        $employer = Employer::where('id', $employerId)->firstOrFail();
        $employer->delete();
        $employer->user->delete();
        RecruitmentNews::where('employer_id', $employerId)->delete();

        return [Response::HTTP_OK, ['status' => Response::HTTP_NO_CONTENT]];
    }
}
