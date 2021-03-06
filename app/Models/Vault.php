<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $table = 'vaults';

    public function user()
    {
        return $this->belongsToMany(User::class)->using(UsersVaults::class);
    }
}
