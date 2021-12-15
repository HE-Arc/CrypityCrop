<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersVaults;

class UsersVaultsController extends Controller
{
    /**
     * Displays the vaults that the user has access
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vault = UsersVaults::where('vault_id', 1)->get();
        //$vault = "test";
        $vaults = array(
            "credentials"=> [
                ["name"=> $vault, "username"=> $vault, "email"=> $vault, "password"=> $vault],
            ]
        );
        
        return inertia('UsersVaults/Index', compact('vaults'));
    }
    
}
