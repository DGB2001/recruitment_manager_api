<?php

namespace App\Services;

use App\Models\Application;
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

    /**
     * getCandidateDetail
     *
     * @param int $candidateId
     * @return array
     */
    public function getCandidateDetail(int $candidateId)
    {
        $candidate = Candidate::with(['user'])->findOrFail($candidateId);
        return [Response::HTTP_OK, $candidate];
    }

    /**
     * updateCandidate
     *
     * @param array $params
     * @return array
     */
    public function updateCandidate(array $params)
    {
        $candidate = Candidate::findOrFail($params['id']);
        $user = $candidate->user;

        DB::beginTransaction();
        try {
            $user->update(['email' => $params['email']]);
            $candidate->update($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }

        return [Response::HTTP_CREATED, ['status' => Response::HTTP_NO_CONTENT]];
    }

    /**
     * getCandidateApplicationList
     *
     * @param int $candidateId
     * @return array
     */
    public function getCandidateApplicationList(int $candidateId)
    {
        $application = Application::with(['masterTechnical', 'masterLevel', 'recruitmentNews.employer'])
            ->where('candidate_id', $candidateId)->orderByDesc('created_at')->get();

        return [Response::HTTP_OK, $application];
    }

    /**
     * deleteCandidate
     *
     * @param int $candidateId
     * @return array
     */
    public function deleteCandidate(int $candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);
        Application::where('candidate_id', $candidateId)->delete();
        $candidate->delete();
        $candidate->user->delete();

        return [Response::HTTP_OK, ['status' => Response::HTTP_NO_CONTENT]];
    }
}
