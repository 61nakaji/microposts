<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(1);

        return view('users.index', [
            'users' => $users,
        ]);
    }
        
        public function show($id)
    {
        $user = User::find($id);
        
        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
}
