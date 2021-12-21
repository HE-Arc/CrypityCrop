<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;
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
        
        $password = Password::all(); //We still need to add the where on the vaults
        //$vault = "test";
        $passwords = null; 
        if ($password != null)
        {
            $passwords = array("credentials" => ['']);
            foreach ($password as $pass)
            {
                array_push($passwords["credentials"],
                    ["name"=> $pass->id, "username"=> $pass->username, "email"=> $pass->email, "password"=> $pass->password]
                );
            }
            unset($passwords["credentials"][0]);

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
}
