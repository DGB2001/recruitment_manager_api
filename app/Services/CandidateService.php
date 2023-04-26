<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Candidate;
use Symfony\Component\HttpFoundation\Response;

class CandidateService implements CandidateServiceInterface
{
    /**
     * createCandidate
     *
     * @return array
     */
    public function createCandidate($params)
    {
        $params['user_id'] = 1;
        DB::beginTransaction();
        try {
            $params['password'] = bcrypt($params['password']);
            $user = User::create($params);
            $params['user_id'] = $user->id;
            Candidate::create($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }
        return [Response::HTTP_CREATED, ['status' => Response::HTTP_CREATED]];
    }
}
