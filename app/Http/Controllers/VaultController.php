<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;
use App\Models\UsersVaults;
use App\Http\Controllers\UsersVaultsController;

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

    public function store(Request $request)
    {
        // Validate the request...

        $vault = new Vault;

        $vault->name = $request["name"];
        $vault->save();
        
        ///Il faudrait lancer en même temps l'insertion dans la table "usersvaults" AVEC UNE MASTERKEY !!!!
        $masterKey = "ulvoerilhghvueéorghueéoragheéorgh";
        UsersVaultsController::store(auth()->user()->id,$vault->id,$masterKey);
        return redirect()->route('passwords.index')->with('success','Vault stored successfully.');
    }

    public function destroy($id)
    {
        $deletedRows = Vault::where('id', $id)->delete();
        return redirect()->route('passwords.index')->with('success','Vault deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        //Only the name can be updated.
        $vaultToUpdate = Vault::find($id);
        $vaultToUpdate->name = $request['name'];
        $vaultToUpdate->save();

        return redirect()->route('passwords.index')->with('success','Vault updated successfully.');
    }

}
