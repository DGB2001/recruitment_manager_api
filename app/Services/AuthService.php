<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthService implements AuthServiceInterface
{
    /**
     * Login function
     *
     * @param Request $request
     * @return array
     */
    public function login($request)
    {
        if (!Auth::attempt(request(['email', 'password']))) {
            return [Response::HTTP_BAD_REQUEST, ['message' => [trans('auth.failed')]]];
        }

        $user = auth()->user();

        if ($user->status == User::STATUS_DEACTIVATED) {
            return [
                Response::HTTP_BAD_REQUEST, [
                    'message' => 'Tài khoản đã bị khóa. Vui lòng liên hệ quản trị viên',
                ]
            ];
        }

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'role' => User::$roles[$user->role],
            'status' => User::$statuses[$user->status],
        ];

        if ($user->role == User::ROLE_CANDIDATE) {
            $data = array_merge($data, ['candidate_id' => $user->candidate->id]);
        }

        if ($user->role == User::ROLE_EMPLOYER) {
            $data = array_merge($data, ['employer_id' => $user->employer->id]);
        }

        return [Response::HTTP_OK, $data];
        // if ($request->grantType == config('const.grant_type.password')) {
        //     // login
        //     if (!Auth::attempt(request(['email', 'password']))) {
        //         return [Response::HTTP_BAD_REQUEST, ['message' => [trans('auth.failed')]]];
        //     }

        //     // check status of user
        //     $user = User::where('email', $request->email)
        //         ->where('active', true)
        //         ->whereNull('deleted_at')
        //         ->first();
        //     if (empty($user)) {
        //         return [Response::HTTP_BAD_REQUEST, ['message' => [trans('auth.failed')]]];
        //     }
        //     $userData['last_logged_in_at'] = now();
        // } else { // refresh token
        // }

        // \DB::beginTransaction();
        // try {
        //     // delete all access token of user
        //     $user->tokens()->delete();

        //     // create new access token
        //     $accessToken = $user->createToken('userToken-' . $user->id, ['role:user'])->plainTextToken;

        //     // update user
        //     $refreshToken = generateHashToken();
        //     $user->update($userData + [
        //         'refresh_token' => $refreshToken,
        //         'refresh_token_expired_at' => now()->addMinutes(config('const.refresh_token_lifetime')),
        //     ]);
        //     \DB::commit();
        // } catch (\Throwable $th) {
        //     \DB::rollback();
        //     \Log::error($th);
        //     return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('auth.failed')]]];
        // }
    }

    /**
     * Logout function
     *
     * @return array
     */
    public function logout()
    {
        if (Auth::user()->currentAccessToken()->delete()) {
            return [Response::HTTP_NO_CONTENT, []];
        } else {
            $response = [
                'message' => 'Log out fail',
            ];
            return [Response::HTTP_BAD_REQUEST, []];
        }
    }
}
