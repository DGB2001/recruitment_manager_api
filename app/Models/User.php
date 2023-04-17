<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_ADMIN = 0;
    const ROLE_CANDIDATE = 1;
    const ROLE_EMPLOYER = 2;

    public static $roles = [
        self::ROLE_ADMIN => 'Quản trị viên',
        self::ROLE_CANDIDATE => 'Ứng viên',
        self::ROLE_EMPLOYER => 'Nhà tuyển dụng',
    ];

    const STATUS_DEACTIVATED = 0;
    const STATUS_ACTIVE = 1;

    public static $statuses = [
        self::STATUS_DEACTIVATED => 'Bị vô hiệu hóa',
        self::STATUS_ACTIVE => 'Đang hoạt động',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

    /**
     * Get the candidate associated with the user.
     */
    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

    /**
     * Get the employer associated with the user.
     */
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }
}
