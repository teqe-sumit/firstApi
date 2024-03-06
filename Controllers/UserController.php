<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => count($users),
            'data' => $users,
            'status' => true
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user != null) {
            return response()->json([
                'message' => 'record found',
                'data' => $user,
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
                'data' => [],
                'status' => true
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'There are some errors',
                'errors' => $validator->errors(),
                'status' => false
            ], 200);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password; // Leaving password as is, assuming it's already hashed elsewhere
        $user->save();

        return response()->json([
            'message' => 'User added successfully',
            'user' => $user,
            'status' => true
        ], 200);
    }

    public function update(Request $request, $id)
    {
        //$user = User::find($id);
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'message' => 'User not found',
                'status' => false
            ], 200);
        }
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'Please fix errors',
        //         'errors' => $validator->errors(),
        //         'status' => false
        //     ], 200);
        //}
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $user,
            'status' => true
        ], 200);
    }

    public function destroy($id)
    {
        
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'message' => 'User not found',
                'status' => false
            ], 200);
        }
        $user->delete();

        return response()->json([
            'message' => 'Deleted successfully',
          
            'status' => true
        ], 200);
    
    }

    
    }

