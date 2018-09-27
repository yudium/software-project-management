<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'business_relationship_status', 'photo'
   ];

    public function type()
    {
        return $this->belongsTo('App\ClientType', 'client_type_id');
    }
}
