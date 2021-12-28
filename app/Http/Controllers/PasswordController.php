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

        PasswordController::updateSingleValue("Tania Is the best with git","password","id",1);
        
        //$password = Password::where('id', auth()->user()->id)->get(); //We still need to add the where on the vaults
        $password = PasswordController::selectAllpasswordsOfUser();
        $folder = PasswordController::selectAllFoldersOfUser();
        $vault = PasswordController::selectAllVaultsOfUser();


        //$vault = "test";

        if ($password != null)
        {
            $mapFolders = [];
            
            //$mapFoldersFolders = []
            foreach ($folder as $fold)
            {
                $mapFolders[$fold->id] = array(
                    "type"=>"folder",
                    "label"=>$fold->name,
                    "nodes"=>[]
                );
            }

            $tree = [];

            foreach ($vault as $vaul)
            {
                $tree[$vaul->id] = [
                    "type"=>"vault", 
                    "label"=>$vaul->name, 
                    "nodes"=>[]
                ];
            }

            foreach ($password as $pass)
            {
                $p = array(
                    "type"=>"key",
                    "label"=>$pass->name
                );
                if ($pass->folder_id != null)
                {
                    array_push($mapFolders[$pass->folder_id]['nodes'], $p);
                }
                else
                {
                    array_push($tree[$pass->vault_id]['nodes'], $p);
                }
            }

            foreach ($folder as $fold)
            {
                if($fold->folder_id != null)
                {
                    array_push($mapFolders[$fold->folder_id]['nodes'], $mapFolders[$fold->id]);
                }
            }

            foreach ($folder as $fold)
            {
                if($fold->folder_id == null)
                {
                    array_push($tree[$fold->vault_id]['nodes'], $mapFolders[$fold->id]);
                }
            }
            
        }
        
        return inertia('Passwords/Index', compact('tree'));
    }

    public function selectWithFoldersAndPasswords()
    {
        //$valuts = DB::table('passwords')->leftJoin('folders', 'vaults.id', '=', 'folders.vault_id')
    }

    public function insertion($request)
    {
        // Validate the request...

        $password = new Password;

        $password->title = $request["title"];
        $password->username = $request["username"];
        $password->email = $request["email"];
        $password->password = $request["password"];
        $password->vault_id = $request["vault_id"];

        $password->save();
    }

    public function deletion(int $id)
    {
        // Validate the request...

        $deletedRows = Password::where('id', $id)->delete();
    }

    public function updateSingleValue(String $value,String $field,String $fieldCondition,int $condition)
    {
        // Validate the request...

        Password::where($fieldCondition,$condition)->update([$field => $value]);

    }

    public function selectAllpasswordsOfUser()
    {
        $passwords = Password::select("*")
                    ->join('usersvaults','usersvaults.vault_id','=','passwords.vault_id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $passwords;
    }

    public function selectAllFoldersOfUser()
    {
        $folders = Folder::select("folders.name","folders.id","folders.vault_id","folders.folder_id")
                    ->join('usersvaults','usersvaults.vault_id','=','folders.vault_id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $folders;
    }

    public function selectAllVaultsOfUser()
    {
        $vaults = Vault::select("*")
                    ->join('usersvaults','usersvaults.vault_id','=','vaults.id')
                    ->join('users','usersvaults.user_id','=','users.id')
                    ->where('users.id',auth()->user()->id)
                    ->get();
        return $vaults;
    }



}
