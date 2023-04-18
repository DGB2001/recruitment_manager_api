<?php

namespace App\Services;

use App\Models\RecruitmentNews;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RecruitmentNewsService implements RecruitmentNewsServiceInterface
{
    /**
     * getListRecruitmentNews
     *
     * @return array
     */
    public function getListRecruitmentNews($params)
    {
        $recruitmentNewsList = RecruitmentNews::with([
            'employer',
            'masterTechnical',
            'masterLevel',
        ])->get();
        return [Response::HTTP_OK, $recruitmentNewsList->map(function ($recruitmentNews) {
            return [
                'id' => $recruitmentNews->id,
                'title' => $recruitmentNews->title,
                'description' => $recruitmentNews->description,
                'salary' => $recruitmentNews->salary,
                'quantity' => $recruitmentNews->quantity,
                'expired_at' => $recruitmentNews->expired_at,
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
}
