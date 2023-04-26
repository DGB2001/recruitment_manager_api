<?php

namespace App\Services;

interface RecruitmentNewsServiceInterface
{
    public function getListRecruitmentNews(array $params);

    public function getRecruitmentNewsDetail(int $recruitmentNewsId);

    public function createRecruitmentNews(array $params);
}
