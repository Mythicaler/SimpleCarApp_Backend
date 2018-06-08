<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use Tymon\JWTAuth\JWTAuth;
use JWTAuthException;

class UserController extends Controller
{
	private $user;
	private $jwtauth;
	public function __construct(User $user, JWTAuth $jwtauth)
	{
		$this->user = $user;
		$this->jwtauth = $jwtauth;
	}

	public function register(Request $request)
	{
		$name = $request->get('name');
		$email = $request->get('email');
		$password = bcrypt($request->get('password'));


		$newUser = User::where('email', '=', $email)->first();

		// return response()->json([
		// 	'status' => 'success'
		// ]);

		if (is_null($newUser)) {
			$newUser = $this->user->create([
          		'name'      => $name,
          		'email'     => $email,
          		'password'  => $password,
         
        	]);
		} else {
			return response()->json([
				'status' => 'User Exiist'
			]);
		}

		if (!$newUser) {
			return response()->json(['failed_to_create_new_user'], 500);
		}
		$newUser->app_token = $this->jwtauth->fromUser($newUser);
		$newUser->save();

		return response()->json([
			'status' => 'success',
			'user' => $newUser
		]);
	}

	public function login(Request $request)
	{
		$credentials = $request->only('email');
		$credentials['password'] = $request->get('password');
		$token = null;
		try {
			$token = $this->jwtauth->attempt($credentials);
			if (!$token) {
				return response()->json(['status' => 'error',
											'error' => 'invalid_email_or_password'
										], 422);
			}
		} catch (JWTAuthException $e) {
			return response()->json(['status' => 'error',
										'error' => 'failed_to_create_token'
									], 500);
		}

		$this->user = $this->jwtauth->toUser($token);
		$this->user->app_token = $token;
		$this->user->save();

		return response()->json([
			'status' => 'success',
			'user' => $this->user
		]);
	}
}



















