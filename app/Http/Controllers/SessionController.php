<?php


namespace App\Http\Controllers;

use App\User;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class SessionController  extends Controller
{
	public function login( Request $request)
	{
		$credentials = $request->only('email', 'password');

		if(Auth::attempt($credentials)) {

			$user = Auth::user();

			$user_response = $this->userResponse($user);

			return response()->json($user_response,200);

		} else {

			$response = "the user have incorrect credentials ";


			return response()->json($response,422);



		}
	}

	private function userResponse($user = null)
	{

		$user_response = [];
		if($user != null){

			$user_response= [
				'name' => $user->name,
				'email' => $user->email
			];

		}

		return $user_response;

	}
}
