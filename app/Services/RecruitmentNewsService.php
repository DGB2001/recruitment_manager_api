<?php

namespace App\Services;

use App\Models\Application;
use App\Models\RecruitmentNews;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RecruitmentNewsService implements RecruitmentNewsServiceInterface
{
    /**
     * getListRecruitmentNews
     *
     * @return array
     */
    public function getListRecruitmentNews(array $params)
    {
        $queryGetRecruitmentNewsList = RecruitmentNews::with([
            'employer',
            'masterTechnical',
            'masterLevel',
        ]);

        if(isset($params['employer_id'])) {
            $queryGetRecruitmentNewsList = $queryGetRecruitmentNewsList->where('employer_id', $params['employer_id']);
        }

        if(isset($params['master_technical_id'])) {
            $queryGetRecruitmentNewsList = $queryGetRecruitmentNewsList->where('master_technical_id', $params['master_technical_id']);
        }

        if(isset($params['master_level_id'])) {
            $queryGetRecruitmentNewsList = $queryGetRecruitmentNewsList->where('master_level_id', $params['master_level_id']);
        }

        if(isset($params['title'])) {
            $queryGetRecruitmentNewsList = $queryGetRecruitmentNewsList->where('title', 'like', '%' . $params['title'] . '%');
        }

        if ($params['order_by'] == 'desc') {
            $recruitmentNewsList = $queryGetRecruitmentNewsList->orderByDesc('created_at')->get();
        }

        if ($params['order_by'] == 'asc') {
            $recruitmentNewsList = $queryGetRecruitmentNewsList->orderBy('created_at', 'asc')->get();
        }

        return [Response::HTTP_OK, $recruitmentNewsList->map(function ($recruitmentNews) {
            return [
                'id' => $recruitmentNews->id,
                'title' => $recruitmentNews->title,
                'description' => $recruitmentNews->description,
                'salary' => $recruitmentNews->salary,
                'quantity' => $recruitmentNews->quantity,
                'expired_at' => Carbon::parse($recruitmentNews->expired_at)->format('d/m/Y'),
                'employer' => $recruitmentNews->employer,
                'master_technical' => $recruitmentNews->masterTechnical,
                'master_level' => $recruitmentNews->masterLevel,
            ];
        })];
    }

    /**
     * getRecruitmentNewsDetail
     *
     * @return array
     */
    public function getRecruitmentNewsDetail($recruitmentNewsId)
    {
        $recruitmentNews = RecruitmentNews::with([
            'employer',
            'masterTechnical',
            'masterLevel',
        ])->findOrFail($recruitmentNewsId);
        return [Response::HTTP_OK, $recruitmentNews];
    }

    /**
     * createRecruitmentNews
     *
     * @param $params
     * @return array
     */
    public function createRecruitmentNews(array $params)
    {
        $params['expired-at'] = date("Y-m-d", strtotime($params['expired_at']));
        DB::beginTransaction();
        try {
            RecruitmentNews::create($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }

        return [Response::HTTP_CREATED, ['status' => Response::HTTP_CREATED]];
    }

    /**
     * updateRecruitmentNews
     *
     * @param array $params
     * @return array
     */
    public function updateRecruitmentNews(array $params)
    {
        $recruitmentNews = RecruitmentNews::where('employer_id', $params['employer_id'])
            ->findOrFail($params['id']);

        DB::beginTransaction();
        try {
            $recruitmentNews->update($params);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }

        return [Response::HTTP_CREATED, ['status' => Response::HTTP_NO_CONTENT]];
    }

    /**
     * updateApplicationResult
     *
     * @param int $recruitmentNewsId
     * @param int $applicationId
     * @param int $result
     * @return array
     */
    public function updateApplicationResult(int $recruitmentNewsId, int $applicationId, int $result)
    {
        $application = Application::where('recruitment_news_id', $recruitmentNewsId)
            ->where('id', $applicationId)->whereNull('result')->firstOrFail();

        DB::beginTransaction();
        try {
            $application->update([
                'result' => $result
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => config('const.message.internal_server_error')]];
        }

        return [Response::HTTP_CREATED, ['status' => Response::HTTP_NO_CONTENT]];
    }

    /**
     * getRecruitmentApplicationList
     *
     * @param int $recruitmentNewsId
     * @return array
     */
    public function getRecruitmentApplicationList(int $recruitmentNewsId)
    {
        $application = Application::with(['candidate', 'masterTechnical', 'masterLevel'])
            ->where('recruitment_news_id', $recruitmentNewsId)->get()->toArray();

        return [Response::HTTP_OK, $application];
    }
}
