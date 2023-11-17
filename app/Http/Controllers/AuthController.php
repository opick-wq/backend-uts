<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function register(Request $request){
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);
        $data = ['message' => 'user is creaated successfully'];

        return response()->json($data, 200);
    }

    public function login(Request $request){
        $input = [
            'email' => $request-> email,
            'password' => $request-> password
        ];

        $user = User::where('email',$input['email'])->first();
        $isLoginSuccessfully = (
            $input['email'] == $user->email && Hash::check($input['password'], $user->password)
        );

        if($isLoginSuccessfully) {
            $token = $user->createToken('Auth_token');

            $data = [
                'message' => 'Login Successfuly',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);

        }else{
            $data = [
                'message' => 'Username or password wrong'
            ];

            return response()->json($data, 401);
        }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
