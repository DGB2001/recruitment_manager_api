<?php

namespace App\Services;

interface RecruitmentNewsServiceInterface
{
    public function getListRecruitmentNews($params);

    public function getRecruitmentNewsDetail($recruitmentNewsId);
}
