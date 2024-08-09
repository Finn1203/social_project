<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\Auth\VerifyAndChangePasswordRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) {
        $this->authService->register($request->validated());

        return response()->json([
            'message' => "Account successfully created."
        ]);
    }

    public function login(LoginRequest $request){
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json([
                'message' => 'Invalid Credentials',
                'error_code' => 401
            ], 401);
        }

        return response()->json([
            'message' => 'Login success',
            'user' => $result['user'],
            'access_token' => $result['access_token']
        ]);
    }

    public function getProfile(Request $request)
    {
        return response()->json($this->authService->getProfile($request->user()));
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }

    public function testMail()
    {
        $this->authService->sendTestMail();
    }

    public function forgetPasswordRequest(ForgetPasswordRequest $request)
    {

        $result = $this->authService->forgetPasswordRequest($request->email);

        if (!$result) {
            return response()->json(['errors' => ['email' => ['Account with this email not found.']]], 422);
        }

        return response()->json(['message' => 'We have sent a code to your email.']);
    }

    public function verifyAndChangePassword(VerifyAndChangePasswordRequest $request)
    {

        $result = $this->authService->verifyAndChangePassword($request->email, $request->code, $request->password);

        if (!$result) {
            return response()->json(['errors' => ['code' => ['Invalid OTP']]], 422);
        }

        return response()->json(['message' => 'Password successfully changed.']);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->authService->changePassword($request->user(), $request->password);

        return response()->json(['message' => 'Password updated successfully.']);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $updatedUser = $this->authService->updateProfile($user, $request->validated());

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => $updatedUser
        ]);
    }
}
