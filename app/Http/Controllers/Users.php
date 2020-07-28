<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use DB;

class Users extends Controller{
	public function user_login(Request $request){

		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
			$user = Auth::user();
			return response() -> json(['token' => $user -> api_token]);
		} else{
			return response()->json(['error'=>'Unauthorised'], 401);
		}
	}

	public function user_new(Request $request){
		$token = Str::random(60);

		$validations = Validator::make(
			[
				'name' => $request["name"],
				'email' => $request["email"],
				'id_type' => $request["id_type"],
				'id_number' => $request["id_number"],
				'genere' => $request["genere"],
				'career' => $request["career"],
			],
			[
				'name' => 'required|min:5',
				'email' => 'required|email|unique:users',
				'id_type' => 'required',
				'id_number' => 'required',
				'genere' => 'required',
				'career' => 'required',
			]
		);

		if($validations -> fails()){
			$messages = $validations -> errors() -> messages();
			$messages["response"] = false;
			return $messages;
		}
		else{
			$request["password"] = bcrypt($request["password"]);
			$request["api_token"] = $token;

			$user = User::forceCreate(request(
				[
					'name',
					'email',
					'password',
					'api_token',
					'id_type',
					'id_number',
					'genere',
					'birthday',
					'career'
				]
			));
			return ["response" => true];
		}
	}

	public function user_edit(Request $request){
		$token = Str::random(60);

		$validations = Validator::make(
			[
				'name' => $request["name"],
				'email' => $request["email"],
				'id_type' => $request["id_type"],
				'id_number' => $request["id_number"],
				'genere' => $request["genere"],
				'career' => $request["career"],
			],
			[
				'name' => 'required|min:5',
				'email' => 'required|email',
				'id_type' => 'required',
				'id_number' => 'required',
				'genere' => 'required',
				'career' => 'required',
			]
		);

		if($validations -> fails()){
			$messages = $validations -> errors() -> messages();
			$messages["response"] = false;
			return $messages;
		}
		else{
			$user = User::find($request -> id_user);

			if($user){
				$user = $user -> update(request(
					[
						'name',
						'email',
						'id_type',
						'id_number',
						'genere',
						'birthday',
						'career'
					]
				));
			}else{
				return response(['message' => 'User don\'t exist', 'response' => false], 400);
			}
			return ["response" => true];
		}
	}

	public function user_delete(Request $request){
		$user = User::find($request -> id_user);
		if($user){
			$user -> delete();
			return response(['response' => true], 200);
		}else{
			return response(['message' => 'User don\'t exist', 'response' => false], 400);
		}
	}

	public function users(Request $request){
		$header = $request->header('Authorization');

		$users = DB::table('users') -> select(DB::raw('*'))
									-> get();
		return $users;
	}
}