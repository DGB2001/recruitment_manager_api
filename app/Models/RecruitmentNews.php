<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitmentNews extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employer_id',
        'master_technical_id',
        'master_level_id',
        'title',
        'description',
        'salary',
        'quantity',
        'expired_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $dates = [
        'expired_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function masterTechnical()
    {
        return $this->belongsTo(MasterTechnical::class);
    }

    public function masterLevel()
    {
        return $this->belongsTo(MasterLevel::class);
    }
}
