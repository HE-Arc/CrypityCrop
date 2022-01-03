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
        $vault = UsersVaults::all();
        //$vault = "test";
        $vaults = null;
        if ($vault != null)
        {
            $vaults = array(
                "credentials"=> [
                    ["name"=> $vault, "username"=> $vault, "email"=> $vault, "password"=> $vault],
                ]
            );
        }
        
        return inertia('UsersVaults/Index', compact('vaults'));
    }

    public static function insertion($user_id,$vault_id,$vault_key)
    {
        // Validate the request...

        $uservault = new UsersVaults;

        $uservault->user_id = $user_id;
        $uservault->vault_id = $vault_id;
        $uservault->vault_key = $vault_key;
        $uservault->save();
    }
    
}
