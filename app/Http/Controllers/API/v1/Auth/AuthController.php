<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Register New User
     * @method POST
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        // Insert User Into Database
        resolve(UserRepository::class)->create($request);

        return response()->json([
            'message' => "user create successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * Login User
     * @method GET
     * @param Request $request
     * @return JsonResponse
     * @throw ValidationException
     */
    public function login(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check User Credentials For Login
        if(Auth::attempt($request->only(['email', 'password']))){
            return response()->json(Auth::user(), Response::HTTP_OK);
        }

        throw ValidationException::withMessages([
            'email' => "incorrect credentials."
        ]);
    }

    /**
     * Show User Info
     * @method GET
     * @return JsonResponse
     */
    public function user()
    {
        return response()->json(Auth::user(), Response::HTTP_OK);
    }

    /**
     * Logout User
     * @method GET
     * @return JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => "user logout successfully"
        ], Response::HTTP_OK);
    }
}
