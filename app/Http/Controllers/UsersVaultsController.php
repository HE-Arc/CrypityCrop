<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersVaults;
use App\Models\User;
use Illuminate\Database\QueryException;

class UsersVaultsController extends Controller
{
    /**
     * Displays the usersvauls relations (unused for now).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Unused
    }

    /**
     * Adds a user-vault relation in the DB. Used when a vault is created.
     */
    public function store($user_id,$vault_id,$vault_key)
    {
        // Validate the request...
        if ($user_id != null && $vault_id != null && $vault_key != null)
        {
            $uservault = new UsersVaults;

            $uservault->user_id = $user_id;
            $uservault->vault_id = $vault_id;
            $uservault->vault_key = $vault_key;
            $uservault->save();
        }
    }

    /**
     * Used to share a vault by a user.
     * When a user verification is ok, a new usersvauts record is made with a vault_key prefixed by "demand". 
     * 
     * @return \Illuminate\Http\Response
     */
    public function shareVaultWithEmail(Request $value)
    {
        if ($value['email'] !== null && $value['vaultId'] !== null)
        {
            $result = User::where('email',$value['email'])->first(); //result can only be 1 or 0.

            if ($result !== null) 
            {
                //Temporary.
                try
                {
                    Self::store($result->id,$value['vaultId'],"demandfvbvhjwkuehlrgerhfejwkflwigvefv");
                }
                catch(QueryException $e)
                {

                    return redirect()->route('passwords.index')->with('error','Unable to share vault');    
                }
                return redirect()->route('passwords.index')->with('success','Vault shared.');
            }
            return redirect()->route('passwords.index')->with('error','Unable to find user');
        }
        return redirect()->route('passwords.index')->with('error','Unable to share vault');
    }

    /**
     * Deletes a users-vauts relation
     */
    public function destroy($id)
    {
        $deletedRows = UsersVaults::where('id', $id)->delete();
        return redirect()->route('passwords.index')->with('success','Vault demand deleted successfully.');
    }

    /**
     * Used to update a usersvaults record when a vault share is accepted.
    */
    public static function updateValidDemand($id)
    {
        $usersvaultToUpdate = UsersVaults::find($id);

        if (!$usersvaultToUpdate->isEmpty() && $usersvaultToUpdate->id != auth()->user()->id) //A user can't share a vault with himself...
        {
            $usersvaultToUpdate->vault_key = str_replace("demand", "", $usersvaultToUpdate->vault_key);
            $usersvaultToUpdate->save();
            return redirect()->route('passwords.index')->with('success','Vault share demand accepted successfully.');
        }
        
        return redirect()->route('passwords.index')->with('error','Unable to accepd vault share demand.');
    }
    
}
