<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    /**
     * Displays the folders that a vault has
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Showing only the top folders (not the sub-folders)
        $folder = Folder::whereNull('folder_id')->get(); //We still need to add the where on the vaults
        //$vault = "test";
        $folders = null;

        if ($folder != null)
        {
            $folders = array(
                "credentials"=> [
                    ["name"=> $folder, "username"=> $folder, "email"=> $folder, "password"=> $folder],
                ]
            );
        }
        else
        {
            $folders = array(
                "credentials"=> [
                    ["name"=> "", "username"=> "", "email"=> "", "password"=> ""],
                ]
            );
        }
        
        return inertia('Folders/Index', compact('folders'));
    }

    public function store(Request $request)
    {
        // Validate the request...

        $folder = new Folder;

        $folder->name = $request["name"];
        if($request["folderId"] != 0)
        {
            $folder->folder_id = $request["folderId"];
        }
        else{
            $folder->folder_id = null;
        }
        
        $folder->vault_id = $request["vaultId"];
        $folder->save();

        //return inertia('Folders/Index', compact('folders'));
        return redirect()->route('passwords.index')->with('success','folder created successfully.');
    }

    public function edit($request)
    {

    }

    public function update($request)
    {
        
    }

    public function destroy($id)
    {
        DB::table('folders')->where('id',$id)->delete();
    }
}
