<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SigninRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login', 'create', 'unauthorized'
            ]
        ]);
    }

    public function create(CreateRequest $request) : JsonResponse
    {
        $data = $request->only(['email', 'password', 'name', 'birthdate', 'city', 'work', 'avatar', 'cover', 'token']);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $response = [
            'error' => '',
            'token' => $user->createToken('Register_token')->plainTextToken
        ];

        return response()->json($response);

    }
}
