<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserDeleteRequest;

use App\Role;

class UserController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate($this->limit);
        $userCount = User::count();
        return view('backend.user.index',compact('users','userCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::select('display_name','id')->get();
        return view('backend.user.create',compact('user','roles')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $userRequest = $request->all();
        $userRequest['slug'] = str_slug($request->name , "-");
        $user = User::create($userRequest);
        $user->attachRole($request->role);
        return redirect('/backend/user')->with("message","New User created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::select('display_name','id')->get();
        return view('backend.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $userRequest = $request->all();
        $userRequest['slug'] = str_slug($request->name , "-");
        $user->update($userRequest);
        $user->detachRoles();
        $user->attachRole($request->role);
        return redirect('/backend/user')->with("message","User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDeleteRequest $request,$id)
    {
        $user = User::findOrFail($id);

        $deleteOption = $request->delete_option;

        $selectedUser = $request->user_id;

        if($deleteOption == 'attribute'){

            $user->posts()->update(['author_id' => $selectedUser]);
        }

         if($deleteOption == 'delete'){

            $user->posts()->withTrashed()->forceDelete();
        }

        $user->delete();

        return redirect('/backend/user')->with("message","User deleted successfully");
    }

    public function confirm($id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id','!=',$id)->get();
      
        return view('backend.user.confirm',compact('user','users'));
    }
}
