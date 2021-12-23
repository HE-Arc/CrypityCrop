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


        $passwords = array("credentials"=> []);

        if ($password != null)
        {
            
            

            $mapFolders = []
            
            //$mapFoldersFolders = []
            foreach ($folder as $fold)
            {
                mapFolders[$fold->id] => ["data"=>$fold, "passwords"=>[], "folders"=>[]];
                
                //mapFoldersFolders[$fold->folder_id] => $fold
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $fold, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }

            foreach ($password as $pass)
            {
                assray_push(mapFolders[$pass->folder_id]['passwords'], $pass);
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $pass, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }

            foreach ($folder as $folder)
            {
                if($fold->id != null)
                {
                    assray_push(mapFolders[$fold->folder_id]['folders'], $fold);
                }
                
                //mapFoldersFolders[$fold->folder_id] => $fold
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $fold, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }

            mapVaults = []
            foreach ($vault as $vaul)
            {
                mapVaults[$vaul->id] => ["data"=>$vaul, "passwords"=>[], "folders"=>[]];
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $vaul, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }

            foreach ($folder as $folder)
            {
                if($fold->id == null)
                {
                    assray_push(mapVaults[$fold->vault_id]['folders'], $fold);
                }
                
                //mapFoldersFolders[$fold->folder_id] => $fold
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $fold, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }
            foreach ($folder as $folder)
            {
                if($fold->id == null)
                {
                    assray_push(mapVaults[$fold->vault_id]['folders'], $fold);
                }
                
                //mapFoldersFolders[$fold->folder_id] => $fold
                /*array_push($passwords["credentials"],
                    //["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                    ["name"=> $fold, "username"=> 1, "email"=> 1, "password"=> 1]
                );*/
            }
            

            

            

        }
        
        return inertia('Passwords/Index', compact('passwords'));
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
        $folders = Folder::select("*")
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
