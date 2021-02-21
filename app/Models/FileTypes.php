<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FileTypes extends Model
{
    protected $fillable = ['directory', 'title', 'extensions', 'max_file_size'];

    public function files() : HasMany
    {
        return $this->hasMany(Files::class);
    }
}