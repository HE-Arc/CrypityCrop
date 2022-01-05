<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;
use App\Models\Folder;
use App\Models\Vault;
use Illuminate\Support\Facades\DB;

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


        //$newPassword = array("title" => "HeARC", "username" => "Jean-Claude Vendame", "email" => "JeanClaude_Vendame@cdd.com", "password" => "42&ChuckNorris", "vault_id" => 1);
        //PasswordController::insertion($newPassword);

        //$value = Password::all()->last();
        //PasswordController::deletion($value->id);

        //PasswordController::updateSingleValue("Tania Is the best with git","password","id",1);

        //$password = Password::where('id', auth()->user()->id)->get(); //We still need to add the where on the vaults
        $passwords = PasswordController::selectAllpasswordsOfUser();
        $folders = PasswordController::selectAllFoldersOfUser();
        $vaults = PasswordController::selectAllVaultsOfUser();


        //$vault = "test";

        if ($passwords != null)
        {
            $mapFolders = [];

            //$mapFoldersFolders = []
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
                if($folder->folder_id != null)
                {
                    array_push($mapFolders[$folder->folder_id]['nodes'], $mapFolders[$folder->id]);
                }
            }

            foreach ($folders as $folder)
            {
                if($folder->folder_id == null)
                {
                    array_push($tree[$folder->vault_id]['nodes'], $mapFolders[$folder->id]);
                }
            }

        }

        return inertia('Passwords/Index', compact('tree'));
    }

    public static function selectWithFoldersAndPasswords()
    {
        //$valuts = DB::table('passwords')->leftJoin('folders', 'vaults.id', '=', 'folders.vault_id')
    }

    public function store(Request $request)
    {
        // Validate the request...

        $password = new Password;

        $password->title = $request["title"];
        $password->username = $request["username"];
        $password->email = $request["email"];
        $password->password = $request["password"];
        $password->vault_id = $request["vaultId"];
        if($request["folderId"] != 0)
        {
            $password->folder_id = $request["folderId"];
        }
        else{
            $password->folder_id = null;
        }

        $password->save();
        return redirect()->route('passwords.index')->with('success','password created successfully.');
    }

    public function destroy($id)
    {
        // Validate the request...

        $deletedRows = Password::where('id', $id)->delete();
        //DB::table('passwords')->where('id', $id)->delete();
        return redirect()->route('passwords.index')->with('success','password deleted successfully.');
    }

    public static function updateSingleValue(String $value,String $field,String $fieldCondition,int $condition)
    {
        // Validate the request...

        Password::where($fieldCondition,$condition)->update([$field => $value]);
    }

    public static function selectAllpasswordsOfUser()
    {
        $passwords = Password::select("passwords.title","passwords.id","passwords.vault_id","passwords.folder_id","passwords.username", "passwords.email", "passwords.password")
                    ->join('usersvaults','usersvaults.vault_id','=','passwords.vault_id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $passwords;
    }

    public static function selectAllFoldersOfUser()
    {
        $folders = Folder::select("folders.name","folders.id","folders.vault_id","folders.folder_id")
                    ->join('usersvaults','usersvaults.vault_id','=','folders.vault_id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->orderbydesc('folder_id')
                    ->get();
        return $folders;
    }

    
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
