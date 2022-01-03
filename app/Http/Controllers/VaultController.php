<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;
use App\Models\UsersVaults;

class VaultController extends Controller
{

    /**
     * Displays the vaults that the user has access
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $vaults = Vault::where('id', auth()->user()->id)->get(); //We still need to add the where on the vaults
        $send = array("credentials"=> []);
        if ($vaults != null)
        {
            foreach ($vaults as $vault)
            {
                array_push($send["credentials"],
                    ["name"=> $vault, "username"=> 1, "email"=> 1, "password"=> 1]
                    
                );
            }
        }
        
        return inertia('Vaults/Index', compact('send'));
    }

    public static function insertion($request)
    {
        // Validate the request...

        $vault = new Vault;

        $vault->name = $request["name"];
        $vault->save();
        UsersVaults::insertion(auth()->user()->id,$vault->id,"fgvbilhvgblegluivrg");

        ///Il faudrait lancer en même temps l'insertion dans la table "usersvaults" !!!!
    }

}
