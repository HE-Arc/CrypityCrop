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
        //Unused
    }

    /**
     * Adds a folder in the DB.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folder = new Folder;

        if ($request["name"] != null && $request["vaultId"] != null)
        {
            $folder->name = $request["name"];
            if($request["folderId"] != 0)
            {
                $folder->folder_id = $request["folderId"];
            }
            else
            {
                $folder->folder_id = null;
            }
            
            $folder->vault_id = $request["vaultId"];
            $folder->save();

            return redirect()->route('passwords.index')->with('success','Folder created successfully.');
        }

        return redirect()->route('passwords.index')->with('error','Unable to crate a folder without no name or without no vaults.');
    }

    /**
     * Used to update a folder.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Only the name of a folder can be updated.
        if ($request["name"] != null)
        {
            $folder = Folder::find($id);
            $folder->name = $request['name'];
            $folder->save();

            return redirect()->route('passwords.index')->with('success','Folder updated successfully.');
        }
        return redirect()->route('passwords.index')->with('error','Unable to update.');
    }

    /**
     * Deletes a folder.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = Folder::where('id', $id)->delete();
        return redirect()->route('passwords.index')->with('success','Folder deleted successfully.');
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
}
