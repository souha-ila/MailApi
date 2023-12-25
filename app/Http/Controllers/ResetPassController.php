<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ResetPassController extends Controller
{
    public function resetPass(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'token' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try{
        $name = $request->name;
        $email = $request->email;
        $token = $request->token;
        Mail::to($email, $name)->queue(new ResetPasswordMail($email, $token, $name));
        return response()->json(["status"=> "success"],200);

        } catch (\Throwable $th) {
            return Helper::handleException($th);
        }
        
    }
}
