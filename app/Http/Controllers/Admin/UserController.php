<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '>', 1)->get();
        return view('admin/users.index',[
            "users"=>$users
        ]);
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

    public function getUserById(Request $request) {
        $userId = $request->userId;
        $user = User::find($userId);

        // $userRoles = $user->roles;
        $userRoles = RoleUser::where('user_id', $userId)->get();

        return $userRoles;
    }

    public function userRoleAdd(Request $request) {
        $userId = $request->userId;
        $userRoles = $request->userRoleArray;

        if($userRoles == "noRole") {
            RoleUser::where('user_id', $userId)->delete();
            return "OK";
        }

        RoleUser::where('user_id', $userId)->delete();

        foreach ($userRoles as $userRole) {
            RoleUser::create(['user_id' => $userId, 'role_id' => $userRole + 1]);
        }
        
        return "OK";
    }
}
