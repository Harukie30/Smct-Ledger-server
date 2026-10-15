<?php

namespace App\Http\Controllers\Controllers;

use App\Enums\RoleNames;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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

        $user = User::whereAny(['email','code'], $validate['email'])->first();

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
                'code'          =>  $user->code,
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

    public function index(Request $request)
    {
        $perPage = $request->input('per_page',10);
        $search = $request->input('search');
        $role = $request->input('role');
        $branch_code = $request->input('branch_code');

        $branchCode = User::groupBy('branch_code')->get(['branch_code']);
        $users = User::with(
                        [
                            'roles' => fn($q) => $q->select(['name'])
                            ]
                        )
                    ->search($search)
                    ->when($role, fn($q) => $q->whereRelation('name', $role))
                    ->when($branch_code, fn($q) => $q->where('branch_code', $branch_code))
                    ->paginate($perPage);

        return response()->json(
            [
                'message'       =>  'List of Users',
                'users'         =>  $users,
                'branch_code'   =>  $branchCode
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
        $validated = $request->validate(
            [
                'name'          =>  ['required','string'],
                'code'          =>  ['required', Rule::unique('users', 'code')],
                'email'         =>  ['nullable', 'email'],
                'branch_code'   =>  ['required'],
                'password'      =>  ['required', 'string', 'min:8', 'max:20']
            ]
        );

        $user = User::create(
            [
                'name'          =>  $validated['name'],
                'code'          =>  $validated['code'],
                'email'         =>  $validated['email'] ?: null,
                'branch_code'   =>  $validated['branch_code'],
                'password'      =>  $validated['password']
            ]
        );

        $user->assignRole(RoleNames::EMPLOYEE->value);

        return response()->json(
            [
                'message'       =>  'User successfully added'
            ]
            ,200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = $user->load(
            [
                'role'  => fn($q) => $q->select(['id', 'name'])
            ]
        );

        return response()->json(
            [
                'message'       =>  'User info',
                'user'          =>  $user
            ]
        );
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
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                'name'          =>  ['sometimes','string'],
                'code'          =>  ['sometimes', Rule::unique('users', 'code')->ignore($user->id)],
                'email'         =>  ['sometimes|nullable', 'email'],
                'branch_code'   =>  ['sometimes'],
                'password'      =>  ['sometimes', 'string', 'min:8', 'max:20'],
                'roles'         =>  ['required','array|numeric']
            ]
        );

        DB::transaction(function () use ($user, $validated) {

            $user->update(
                [
                    'name'          =>  $validated['name'] ?: $user->name,
                    'code'          =>  $validated['code'] ?: $user->code,
                    'email'         =>  $validated['email'] ?: $user->email,
                    'branch_code'   =>  $validated['branch_code'] ?: $user->branch_code,
                    'password'      =>  $validated['password'] ?: $user->password
                ]
            );

            $role_id = Role::findOrFail($validated['roles']);

            $user->syncRoles($role_id);

            return response()->json(
                [
                    'message'       =>  'User updated successfully'
                ]
            );

        });

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(
            [
                'message'   =>  'User Deleted'
            ]
        );
    }
}
