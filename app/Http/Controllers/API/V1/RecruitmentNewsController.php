<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\CreateRecruitmentNewsRequest;
use App\Http\Requests\GetRecruitmentNewsListRequest;
use App\Http\Requests\UpdateApplicationResultRequest;
use App\Http\Requests\UpdateRecruitmentNewsRequest;
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
     * @param GetRecruitmentNewsListRequest $request
     * @return json
     */
    public function getListRecruitmentNews(GetRecruitmentNewsListRequest $request)
    {
        list($statusCode, $data) = $this->recruitmentNewsService->getListRecruitmentNews($request->all());

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

    /**
     * createRecruitmentNews
     *
     * @param CreateRecruitmentNewsRequest $request
     * @return json
     */
    public function createRecruitmentNews(CreateRecruitmentNewsRequest $request)
    {
        list($statusCode, $data) = $this->recruitmentNewsService->createRecruitmentNews($request->all());

        return $this->response($data, $statusCode);
    }

    /**
     * updateRecruitmentNews
     *
     * @param UpdateRecruitmentNewsRequest $request
     * @param int $recruitmentNewsId
     * @return json
     */
    public function updateRecruitmentNews(UpdateRecruitmentNewsRequest $request, int $recruitmentNewsId)
    {
        $params = $request->all();
        $params['id'] = $recruitmentNewsId;
        list($statusCode, $data) = $this->recruitmentNewsService->updateRecruitmentNews($params);

        return $this->response($data, $statusCode);
    }

    /**
     * updateApplicationResult
     *
     * @param UpdateApplicationResultRequest $request
     * @param int $recruitmentNewsId
     * @param int $applicationId
     * @return json
     */
    public function updateApplicationResult(UpdateApplicationResultRequest $request, int $recruitmentNewsId, int $applicationId)
    {
        list($statusCode, $data) = $this->recruitmentNewsService->updateApplicationResult(
            $recruitmentNewsId,
            $applicationId,
            $request->result
        );

        return $this->response($data, $statusCode);
    }
}
