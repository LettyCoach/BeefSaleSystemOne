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
        $roles = Role::where('id','>',1)->get();
        $users = User::where('id', '>', 1)->get();
        return view('admin/users.index',[
            "users"=>$users, 'roles' =>$roles,
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
    public function destroy(Request $request)
    {
        $userId = $request->userId;
        User::find($userId)->delete();
        return "OK";
    }

    public function getUserById(Request $request) {
        $userId = $request->userId;
        $user = User::find($userId);

         $userRoles = $user->roles;
       // $userRoles = RoleUser::where('user_id', $userId)->get();
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

    public function getUserList(Request $request) {

        $pageSize = $request->pageSize;
        $pageNumber = $request->pageNumber;
        $userName = $request->userName;
        $userEmail = $request->userEmail;

        $users = User::where('id', '>', 1);
        $totalCnt = $users->count();

        if($userName != "") {
            $users = $users->where('name', 'like', '%' . $userName . '%');
            $totalCnt = $users->count();
        }

        if($userEmail != "") {
            $users = $users->where('email', 'like', '%' . $userEmail . '%');
            $totalCnt = $users->count();
        }

        if(($totalCnt % $pageSize) == 0) {
            $pageCnt = $totalCnt / $pageSize;
        } else {
            $pageCnt = $totalCnt / $pageSize;
            $pageCnt = (int)$pageCnt + 1;
        }

        $users = $users->limit($pageSize)
            ->offset(($pageNumber - 1) * $pageSize)
            ->get();
        
        return view('admin.users.list')
            ->with('users', $users)
            ->with('pageCnt', $pageCnt)
            ->with('pageNumber', $pageNumber)
            ->with('pageSize', $pageSize)
            ->with('totalCnt', $totalCnt);
    }
}
