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
        $folders = array(
            "credentials"=> [
                ["name"=> $folder, "username"=> $folder, "email"=> $folder, "password"=> $folder],
            ]
        );
        
        return inertia('Folders/Index', compact('folders'));
    }
}
