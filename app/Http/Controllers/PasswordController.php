<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\VaultController;
use Illuminate\Support\Facades\DB;

class PasswordController extends Controller
{
    /**
     * Displays the passwords,vaults & folders that the user has access to.$_FILES
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $passwords = PasswordController::selectAllpasswordsOfUser();
        $folders = FolderController::selectAllFoldersOfUser();
        $vaults = VaultController::selectAllVaultsOfUser();

        if ($passwords != null)
        {
            $mapFolders = [];

            foreach ($folders as $folder)
            {
                $mapFolders[$folder->id] = array(
                    "id" => $folder->id,
                    "vault_id" => $folder->vault_id,
                    "type" =>"folder",
                    "title"=>$folder->name,
                    "nodes"=>[]
                );
            }

            $tree = [];

            foreach ($vaults as $vault)
            {
                $tree[$vault->id] = [
                    "id" => $vault->id,
                    "type" =>"vault",
                    "title"=>$vault->name,
                    "nodes"=>[]
                ];
            }

            foreach ($passwords as $password)
            {
                $p = array(
                    "id" => $password->id,
                    "type" =>"password",
                    "title"=>$password->title,
                    "username"=>$password->username,
                    "email"=>$password->email,
                    "password"=>$password->password
                );
                if ($password->folder_id != null)
                {
                    array_push($mapFolders[$password->folder_id]['nodes'], $p);
                }
                else
                {
                    array_push($tree[$password->vault_id]['nodes'], $p);
                }
            }

            foreach ($folders as $folder)
            {
                if ($folder->folder_id != null)
                {
                    array_push($mapFolders[$folder->folder_id]['nodes'], $mapFolders[$folder->id]);
                }
            }

            foreach ($folders as $folder)
            {
                if ($folder->folder_id == null)
                {
                    array_push($tree[$folder->vault_id]['nodes'], $mapFolders[$folder->id]);
                }
            }

        }

        return inertia('Passwords/Index', compact('tree'));
    }

    /**
     * Adds a password in the DB.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request["title"] != null && $request["vaultId"] != null)
        {
            $password = new Password;

            $password->title = $request["title"];

            if (isset($request["username"]))
                $password->username = $request["username"];
            if (isset($request["email"]))
                $password->email = $request["email"];
            if (isset($request["password"]))
                $password->password = $request["password"];
            if (isset($request["vaultId"]))
                $password->vault_id = $request["vaultId"];

            if($request["folderId"] != 0)
            {
                $password->folder_id = $request["folderId"];
            }
            else
            {
                $password->folder_id = null;
            }

            $password->save();
            return redirect()->route('passwords.index')->with('success','password created successfully.');
        }

        return redirect()->route('passwords.index')->with('error','Unable to create a password.');

    }

    /**
     * Deletes a passwords.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = Password::where('id', $id)->delete();
        return redirect()->route('passwords.index')->with('success','password deleted successfully.');
    }

    /**
     * Used to update a password record.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request["title"] != null)
        {
            $passwordToUpdate = Password::find($id);
            $passwordToUpdate->title = $request["title"];
            if ($request["username"] != null)
            {
                $passwordToUpdate->username = $request["username"];
                $passwordToUpdate->email = $request["email"];
                $passwordToUpdate->password = $request["password"];
            }

            $passwordToUpdate->save();
            return redirect()->route('passwords.index')->with('success','Password updated successfully.');
        }
        return redirect()->route('passwords.index')->with('error','Unable to update password.');
    }

    /**
     * Used to select all passwords of a user.
     * @return \App\Models\Password;
     */
    public static function selectAllpasswordsOfUser()
    {
        $passwords = Password::select("passwords.title","passwords.id","passwords.vault_id","passwords.folder_id","passwords.username", "passwords.email", "passwords.password")
                    ->join('usersvaults','usersvaults.vault_id','=','passwords.vault_id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $passwords;
    }
}
