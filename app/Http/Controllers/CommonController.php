<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;


class CommonController extends Controller
{
    public function validator($jsonData, $rules)
    {
        $validator = Validator::make($jsonData, $rules);
        $error_messages = $validator->errors()->first();

        if ($validator->fails()) {
            return [
                'error' => $error_messages,
                'response' => false,
                // 'all_errors'=> $validator->errors()
            ];
        } else {
            return [
                'error' => $error_messages,
                'response' => true,
                // 'all_errors'=> $validator->errors()
            ];
        }
    }
}
