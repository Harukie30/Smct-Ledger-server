<?php

namespace App\Http\Controllers\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login(Request $request)
    {
        $validate = $request->validate(
            [
                'email'        =>  ['required'],
                'password'     =>  ['required']
            ]
        );

        $user = User::whereAny(['email','branch_code'], $validate['email'])->first();

        if(!$user)
        {
            return response()->json(
                [
                    'message'       =>  "Email/Branch-code not found"
                ]
                ,404
            );
        }

        $credentials = [];
        if(filter_var($validate['email'], FILTER_VALIDATE_EMAIL))
        {
            $credentials = [
                'email'     =>  $user->email,
                'password'  =>  $validate['password']
            ];
        }else{
            $credentials = [
                'branch_code'   =>  $user->branch_code,
                'password'      =>  $validate['password']
            ];
        }

        if(!Auth::attempt($credentials))
        {
            return response()->json(
                [
                    'message'     => 'Invalidate Credentials'
                ]
                ,400
            );
        }

        return response()->json(
            [
                'message'       =>  'User Login Successful'
            ]
        );
    }

    public function index()
    {
        return response()->json(
            [
                'message'  =>  'test'
            ]
        );
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
