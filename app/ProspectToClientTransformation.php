<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectToClientTransformation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_at',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
