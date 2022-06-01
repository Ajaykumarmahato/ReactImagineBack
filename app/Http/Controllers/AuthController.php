<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return DB::transaction(function () use ($UserData, $file) {
            $newUser = User::create($UserData);
            $newUser->addMedia($file)->toMediaCollection('user');
            return $this->respond($newUser, 'User Registered Successfully');
        });
    }
}
