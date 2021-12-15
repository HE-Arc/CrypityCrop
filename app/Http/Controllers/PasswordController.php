<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;

class PasswordController extends Controller
{
        /**
     * Displays the vaults that the user has access
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Showing only the top folders (not the sub-folders)
        $password = Password::all()->first(); //We still need to add the where on the vaults
        //$vault = "test";
        $passwords = array(
            "credentials"=> [
                ["name"=> $password->title, "username"=> $password->username, "email"=> $password->email, "password"=> $password->password],
            ]
        );
        
        return inertia('Passwords/Index', compact('passwords'));
    }
}
