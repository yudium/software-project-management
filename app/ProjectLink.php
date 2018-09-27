<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link_text',
    ];
}
