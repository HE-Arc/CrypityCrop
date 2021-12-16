<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;

class VaultController extends Controller
{

    /**
     * Displays the vaults that the user has access
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaults = Vault::all();
        //$vault = "test";
        $vaultes = null;
        if ($vaults != null)
        {
            $vaultes = array(
                "credentials"=> [
                    ["name"=> $vaults, "username"=> $vaults, "email"=> $vaults, "password"=> $vaults],
                ]
            );
        }
        
        return inertia('Vaults/Index', compact('vaultes'));
    }

}
