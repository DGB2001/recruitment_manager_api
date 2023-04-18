<?php

namespace App\Http\Controllers\API\V1;

use App\Services\RecruitmentNewsServiceInterface;
use Illuminate\Http\Request;

class RecruitmentNewsController extends BaseController
{
    protected $recruitmentNewsService;

    /**
     * Create a new instance
     *
     * @param RecruitmentNewsServiceInterface $recruitmentNewsService
     */
    public function __construct(RecruitmentNewsServiceInterface $recruitmentNewsService)
    {
        $this->recruitmentNewsService = $recruitmentNewsService;
    }

    /**
     * getListRecruitmentNews
     *
     * @param Request $request
     * @return json
     */
    public function getListRecruitmentNews(Request $request)
    {
        list($statusCode, $data) = $this->recruitmentNewsService->getListRecruitmentNews($request);

        return $this->response($data, $statusCode);
    }

    /**
     * getRecruitmentNewsDetail
     *
     * @param int $recruitmentNewsId
     * @return json
     */
    public function getRecruitmentNewsDetail(int $recruitmentNewsId)
    {
        list($statusCode, $data) = $this->recruitmentNewsService->getRecruitmentNewsDetail($recruitmentNewsId);

        return $this->response($data, $statusCode);
    }
}
