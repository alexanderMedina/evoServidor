<?php


namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

		if($user != null) {
			$user_response= [
				'name' => $user->name,
				'email' => $user->email
			];
		}
		return $user_response;
	}

	private function setUpUser($name , $email, $password)
	{

		$user_array = [];

		$user_array= [
				'name' => $name['name'],
				'email' => $email['email'],
				'password' =>$password,
				'remember_token'=> NULL
			];

		return $user_array;
	}

	
	public function userLogout()
	{
		Auth::logout();
		$response = "Session ended";
		return response()->json($response,200);
	}

	public function create( Request $request)
	{
		$name = $request->only('name');
		$email = $request->only('email');
		$password = $request->only('password');
		$new_password = Hash::make($password['password']);

		$user_array = $this->setUpUser($name, $email, $new_password);

		$user_id = DB::table('users')->insertGetId($user_array);

		$response = "the user number ".$user_id." have been created ";

		return response()->json($response,200);

	}

	public function createDog( Request $request)
	{
		$name = $request->only('name');
		$gender = $request->only('gender');
		$user_id = $request->only('user_id');
		$age = $request->only('age');
		$breed = $request->only('breed');

		$dog_array = $this->setUpDog($name, $gender, $user_id,$age,$breed);

		$dog_id = DB::table('dogs')->insertGetId($dog_array);

		$response = "the dog number ".$dog_id." have been created ";

		return response()->json($response,200);

	}

	private function setUpDog($name , $gender, $user_id,$age,$breed)
	{

		$dog_array = [];

		$dog_array= [
			'name' => $name['name'],
			'gender' => $gender['gender'],
			'user_id' =>$user_id['user_id'],
			'age'=> $age['age'],
			'breed' => $breed['breed']
		];

		return $dog_array;
	}

}
