<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vault;
use App\Models\UsersVaults;
use App\Http\Controllers\UsersVaultsController;

class VaultController extends Controller
{

    /**
     * Displays the vaults that the user has access to. Unused fo now.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Unused
    }

    /**
     * Adds a vault in the DB.
     * When a vault is inserted. A new user-vault relation needs also to be added.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request...
        if ($request["name"] != null)
        {
            $vault = new Vault;

            $vault->name = $request["name"];
            $vault->save();
            
            //Temporary.
            $masterKey = "ulvoerilhghvueéorghueéoragheéorgh";

            UsersVaultsController::store(auth()->user()->id, $vault->id, $masterKey); 

            return redirect()->route('passwords.index')->with('success','Vault stored successfully.');
        }

        return redirect()->route('passwords.index')->with('error','Unable to create a vault');
    }

    /**
     * Deletes a vault.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relations = UsersVaults::where('vault_id', $id)->get();

        if(sizeof($relations) == 1)
        {
            $deletedRows = Vault::where('id', $id)->delete();
        }
        else
        {
            foreach ($relations as $uv) {
                if($uv->vault_id == $id && $uv->user_id == auth()->user()->id)
                {
                    $uv->delete();
                }
            }
        }
        return redirect()->route('passwords.index')->with('success','Vault deleted successfully.');
    }

    /**
     * Used to update a vault.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request["name"] != null)
        {
            //Only the name can be updated.
            $vaultToUpdate = Vault::find($id);
            $vaultToUpdate->name = $request['name'];
            $vaultToUpdate->save();

            return redirect()->route('passwords.index')->with('success','Vault updated successfully.');
        }

        return redirect()->route('passwords.index')->with('success','Unable to update the vault');

    }

    /**
     * Used to select all vaults of a user.
     * @return \App\Models\Password;
     */
    public static function selectAllVaultsOfUser()
    {
        $vaults = Vault::select("vaults.name","vaults.id")
                    ->join('usersvaults','usersvaults.vault_id','=','vaults.id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $vaults;
    }

}
