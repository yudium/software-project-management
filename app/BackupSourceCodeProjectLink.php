<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackupSourceCodeProjectLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link_text',
    ];

    public $timestamps = false;
}
