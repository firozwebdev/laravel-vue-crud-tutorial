<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); // it will retrieve all users.
        return response()->json($users,200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user) // this is called implicit model binding
    {
        if($request->hasfile('image')){
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName(); //name should be same for image so we will use time function before image name.
            $file->move(public_path().'/img/',$name);
        }else{
            $name = '';
        }
        
        
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->image = $name; 
        $user->password = bcrypt( $request->get('password'));

        $user->save();

        return response()->json([
            'message' => 'User created successfully !!',
            'user' => $user,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->hasfile('image')){
            $file = $request->file('image');
            $name = time().$file->getClientOriginalName(); //name should be same for image so we will use time function before image name.
            $file->move(public_path().'/img/',$name);
        }else{
            $name = '';
        }

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->image = $name; 
        $user->update();
        return response()->json([
            'message' => 'User updated successfully !!',
            'user' => $user,
        ],201);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user);
    }
}
