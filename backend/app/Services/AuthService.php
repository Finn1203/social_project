<?php
namespace App\Services;

use App\Repositories\Auth\AuthRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Mail\ForgotPasswordEmail;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register($data)
    {
        return $this->authRepository->create($data);
    }

    public function login($credentials)
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }
        $user = Auth::user();
        $user->tokens()->delete();

        // Create a new access token for the authenticated user with the 'user' scope
        $token = $user->createToken('access_token', ['user']);

        // Return the authenticated user with their notifications and the new access token
        return [
            'user' => $user, //load('notifications'),
            'access_token' => $token->plainTextToken
        ];
    }

    public function getProfile($user)
    {
        return $user;
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        return true;
    }

    public function sendTestMail()
    {
        $data = [
            'name' => 'Joe Doe',
            'body' => "this is a test message"
        ];
        Mail::to('nguyennamphi39@gmail.com')->send(new TestMail('test subject', $data));
    }

    public function forgetPasswordRequest($email)
    {
        $user = $this->authRepository->findByEmail($email);

        if (!$user) {
            return null;
        }

        $code = rand(11111, 99999);
        $user->remember_token = $code;
        $user->save();

        $data = [
            'name' => $user->first_name.' '.$user->last_name,
            'code' => $code,
        ];

        Mail::to($user->email)->send(new ForgotPasswordEmail('Forgot Password Request', $data));

        return true;
    }

    public function verifyAndChangePassword($email, $code, $newPassword)
    {
        $user = $this->authRepository->findByEmailAndCode($email, $code);

        if (!$user) {
            return null;
        }

        $user->remember_token = null;
        $user->password = bcrypt($newPassword);
        $user->save();

        return true;
    }

    public function changePassword($user, $newPassword)
    {
        $user->password = bcrypt($newPassword);
        $user->save();

        return true;
    }

    public function updateProfile($user, $data)
    {
        return $this->authRepository->update($user->id, $data);
    }
}
