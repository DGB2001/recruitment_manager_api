<?php

namespace App\Services;

interface RecruitmentNewsServiceInterface
{
    public function getListRecruitmentNews(array $params);

    public function getRecruitmentNewsDetail(int $recruitmentNewsId);

    public function createRecruitmentNews(array $params);

    public function updateRecruitmentNews(array $params);

    public function updateApplicationResult(int $recruitmentNewsId, int $applicationId, int $result);

    public function getRecruitmentApplicationList(int $recruitmentNewsId);
}
