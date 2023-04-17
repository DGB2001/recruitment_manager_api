<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;

    const RESULT_PASS = 0;
    const RESULT_FAIL = 1;

    public static $results = [
        self::RESULT_FAIL => 'Từ chối',
        self::RESULT_PASS => 'Chấp nhận',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'candidate_id',
        'master_technical_id',
        'master_level_id',
        'recruitment_news_id',
        'title',
        'content',
        'result',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function masterTechnical()
    {
        return $this->belongsTo(MasterTechnical::class);
    }

    public function masterLevel()
    {
        return $this->belongsTo(MasterLevel::class);
    }

    public function recruitmentNews()
    {
        return $this->belongsTo(RecruitmentNews::class);
    }
}
