<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function GuzzleHttp\json_decode;

class FileTypes extends Model
{
    protected $fillable = ['id', 'directory', 'title', 'extensions', 'max_file_size'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
        'updated_at' => 'datetime:d/m/Y',
    ];

    private $_EXTENSIONS;

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDirectory(){
        return $this->directory;
    }

    public function files() : HasMany
    {
        return $this->hasMany(Files::class);
    }

    public function getExtensions(){

        foreach ($this->getExtensionsDecoded() as $key => $value){
            $plus = count($this->getExtensionsDecoded()) > ++$key ? ', ' : '';
            $this->_EXTENSIONS .= $value->name.$plus;
        }

        return $this->_EXTENSIONS;
    }

    public function getExtensionsDecoded(){
        return json_decode($this->extensions);
    }

    public function getMaxFileSize(){
        return $this->max_file_size ? $this->max_file_size. ' Mb' : '';
    }

    public function getCreatedAt(){
        return $this->created_at;
    }
}