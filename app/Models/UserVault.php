<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVault extends Pivot{

    use HasFactory;

    protected $hidden = ['vault_key'];
    protected $table = 'user_vault';
    protected $primaryKey = 'user_vault_id';


}
