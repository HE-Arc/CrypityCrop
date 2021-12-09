<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','username','email','password',
    ];

    function vault() {
        return $this->belongsTo(Vault::class);
    }

    function folder() {
        return $this->belongsTo(Folder::class);
    }
}
