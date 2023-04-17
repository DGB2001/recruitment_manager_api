<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService implements UserServiceInterface
{
    /**
     * Get list user
     *
     * @return array
     */
    public function getUser()
    {

        $users = User::query()->select('id', 'name', 'email', 'password')->get();
        return [Response::HTTP_OK, [
            'users' => $users,
        ]];
    }

    /**
     * Insert user
     *
     * @param object $request
     * @return array
     */
    public function addUser($request)
    {
        try {
            $data = $request->validated();
            $refreshToken = generateHashToken();
            $data['password'] = Hash::make($data['password']);
            User::create($data + [
                'refresh_token' => $refreshToken,
                'refresh_token_expired_at' => now()->addMinutes(config('const.refresh_token_lifetime')),
            ]);
        } catch (Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => $e->getMessage()]];
        }
        return [Response::HTTP_CREATED, [
            'message' => 'Insert user success',
        ]];
    }

    /**
     * Update user by id
     *
     * @param object $request
     * @return array
     */
    public function updateUser($request)
    {
        try {
            $user = User::find($request['id']);
            if (empty($user)) {
                return [Response::HTTP_BAD_REQUEST, ['message' => 'User does not exist']];
            }
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            User::where('id', $request['id'])->update($data);
        } catch (Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => $e->getMessage()]];
        }
        return [Response::HTTP_CREATED, [
            'message' => 'Update user success',
        ]];
    }

    /**
     * Delete user by id
     *
     * @param int $id
     * @return array
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            if (empty($user)) {
                return [Response::HTTP_BAD_REQUEST, ['message' => 'User does not exist']];
            }
            User::destroy($id);
        } catch (Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => $e->getMessage()]];
        }
        return [Response::HTTP_NO_CONTENT, [
            'message' => 'Delete user success',
        ]];
    }
}
