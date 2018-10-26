<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use Response;
use App\Transformers\UserTransformer;
use \Illuminate\Http\Response as Res;
use Validator;

class UserController extends ApiController
{/* 
    protected $userTransformer;

    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    } */

    /** Get access token for the user */
    public function authenticate(Request $request)
    {

        $rules = array (
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator-> fails()){
            return $this->respondValidationError('Validation Failed.', $validator->errors());
        }else{
            try {
                $credentials = $request->only('email', 'password');
                if (! $token = JWTAuth::attempt($credentials)) {
                    return $this->respondWithError("Invalid Email or Password");
                }else{
                    $message = "success";
                 return $this->respondCreated(
                         $message,
                        compact('token')
                    );
                }
            } catch (JWTException $e) {
                return $this->respondInternalError("Login failed. ".$e->getMessage());
                }
            }

        }

        
    

    /* 
    
    This code is commented. I used it to create a test account for the client. Otherwise it should not be there

    public function register(Request $request)
    {
        $rules = array (
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){ 
            return $this->respondValidationError('Validation failed.', $validator->errors());
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        //$user =$this->userTransformer->transform($user);

        $token = JWTAuth::fromUser($user);
        $message = "success";
        return $this->respondCreated(
            $message,
            compact('user','token')
        );
       
    }
 */
    public function getAuthenticatedUser()
        {
            try {
                if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
                    }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                return response()->json(['token_expired'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                return response()->json(['token_invalid'], $e->getStatusCode());

            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                return response()->json(['token_absent'], $e->getStatusCode());

            }

            return response()->json(compact('user'));
        }
}