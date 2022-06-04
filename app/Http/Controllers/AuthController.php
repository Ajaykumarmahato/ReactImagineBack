<?php

namespace App\Http\Controllers;

use App\ApiCode;
use App\Models\User;
use App\Notifications\NotifyEmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $data = $request->all();
        $UserData = null;
        if (array_key_exists('user', $data)) {
            $jsonData = json_decode($data['user']);
            $UserData = snake_keys($jsonData);
        }

        $file = null;
        if (array_key_exists('file', $data)) {
            $file = $data['file'];
        }
        $commonController = new CommonController();
        $rules = [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required'
        ];
        $validation = $commonController->validator($UserData, $rules);
        if ($validation['response'] == false) {
            return $this->respondErrorWithMessage($validation['error'], ApiCode::VALIDATION_ERROR, 401);
        }
        return DB::transaction(function () use ($UserData, $file) {
            $UserData['password'] = bcrypt($UserData['password']);
            $UserData['status'] = "Disabled";
            $newUser = User::create($UserData);
            if ($file) {
                $newUser->addMedia($file)->toMediaCollection('user');
            }
            $paramData = [
                'user' => $newUser
            ];
            Notification::route('mail', $newUser['email'])->notify(new NotifyEmailVerification($paramData));
            return $this->respond($newUser, 'User Registered Successfully');
        });
    }



    public function login(Request $request)
    {
        $data = $request->all();
        $commonController = new CommonController();

        $rules = [
            'email' => ['required', 'email'],
            'password' => 'required'
        ];
        $validation = $commonController->validator($data, $rules);

        if ($validation['response'] == false) {
            return $this->respondErrorWithMessage($validation['error'], ApiCode::VALIDATION_ERROR, ApiCode::VALIDATION_ERROR);
        }
        $credentials = request(['email', 'password']);
        $credentials['status'] = "Enabled";
        $user = User::where('email', request('email'))->first();
        if ($user != null) {
            if (auth()->attempt($credentials)) {
                $authUser = Auth::user();
                $tokenResult = auth()->user()->createToken('imagine');
                return $this->respondWithToken($tokenResult);
            }
            return $this->respondErrorWithMessage('User not authenticated', ApiCode::FORBIDDEN, ApiCode::FORBIDDEN);
        } else {
            return $this->respondErrorWithMessage('Invalid Credentials', ApiCode::INVALID_CREDENTIALS, ApiCode::INVALID_CREDENTIALS);
        }
    }

    public function respondWithToken($tokenResult)
    {
        return $this->respond([
            'access_type' => 'bearer',
            'token' => $tokenResult->accessToken,
            'expires_in' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'roles' => Auth::user()->roles->pluck('name'),
            'permissions' => Auth::user()->getAllPermissions(),

        ]);
    }


    public function verifyEmail($email, $id)
    {
        $decodedEmail = base64_decode($email);
        $decodedId = base64_decode($id);

        $user = USer::where('id', $decodedId)->where('email', $decodedEmail)->update([
            'email_verified_at' => Carbon::now(),
            'status' => 'Enabled'
        ]);
        return redirect()->to(env('FRONTEND_URL', 'http://localhost:3000'));
    }
}
