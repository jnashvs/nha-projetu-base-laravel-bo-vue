<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Files extends Authenticatable
{
    use Notifiable, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'path' => [
            'searchable' => true,
        ],
        'size' => [
            'searchable' => true,
        ]
    ];

    protected $dataTableRelationships = [
        //
    ];

    protected $fillable = ['path', 'width', 'height', 'size', 'file_type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(FileType::class, 'file_type_id');
    }
}