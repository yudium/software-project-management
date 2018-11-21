<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * correspond to `status` column in table
     */
    const IS_DRAFT          = '0';
    const IS_ONPROGRESS     = '1';
    const IS_DONE_SUCCESS   = '2';
    const IS_DONE_FAIL      = '3';

    /**
     * correspond to `payment_method` column in table
     *
     * client pays in full                   then PAYMENT_BY_FULLCASH
     * client pays in installments (cicilan) then PAYMENT_BY_TERMIN
     *
     * can contains NULL value that means admin hasn't set the payment method
     * for current project. Also, that means the project still in IS_DRAFT
     * status.
     */
    const PAYMENT_BY_FULLCASH = '0';
    const PAYMENT_BY_TERMIN   = '1';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'starttime',
        'endtime',
        'endtime_actual',
        'DP_time',
        'additional_note',
        'status',
        'trello_board_id',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function project_type()
    {
        return $this->belongsTo('App\ProjectType');
    }

    public function PICs()
    {
        return $this->hasMany('App\PIC');
    }

    public function backup_source_code_project_links()
    {
        return $this->hasMany('App\BackupSourceCodeProjectLink');
    }

    public function project_links()
    {
        return $this->hasMany('App\ProjectLink');
    }

    public function termin()
    {
        return $this->hasOne('App\Termin');
    }

    public function potential_project()
    {
        return $this->hasOne('App\PotentialProject');
    }

    public function tags()
    {
        return $this->hasMany('App\ProjectTag');
    }

    public function getPaymentMethodTextAttribute()
    {
        if ($this->payment_method == self::PAYMENT_BY_FULLCASH) return 'Full cash';
        if ($this->payment_method == self::PAYMENT_BY_TERMIN) return 'Termin';
        return null;
    }

    public function getIsPaymentMethodTerminAttribute()
    {
        return $this->payment_method == self::PAYMENT_BY_TERMIN;
    }

    public function getIsPaymentMethodFullcashAttribute()
    {
        return $this->payment_method == self::PAYMENT_BY_FULLCASH;
    }

    public function getIsDraftAttribute()
    {
        return $this->status == self::IS_DRAFT;
    }

    public function getIsOnprogressAttribute()
    {
        return $this->status == self::IS_ONPROGRESS;
    }

    public function getIsDoneAttribute()
    {
        return $this->is_done_fail OR $this->is_done_success;
    }

    public function getIsDoneFailAttribute()
    {
        return $this->status == self::IS_DONE_FAIL;
    }

    public function getIsDoneSuccessAttribute()
    {
        return $this->status == self::IS_DONE_SUCCESS;
    }

    /**
     * For using with DataTable plugin as Ajax response
     *
     * @param $array    contains
     *                      (1) Response status (HTTP Code) for example: 200
     *                      (2) Response message for example: Error message
     *                      (3) Data, contains:
     *                            (a) progress percent (number in tens),
     *                            (b) number of task (number),
     *                            (c) number of task complete (number)
     *                            (d) last progress activity (array or json from trello api)
     *
     *                  NOTE: can be null if project not have trello
     */
    public function setProgressAttribute($array)
    {
        // add new attribute with name 'progress'
        $this->attributes['progress'] = $array;
    }
}
