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

    public function getPaymentMethodTextAttribute()
    {
        if ($this->payment_method == self::PAYMENT_BY_FULLCASH) return 'Full cash';
        if ($this->payment_method == self::PAYMENT_BY_TERMIN) return 'Menyicil';
        return 'Belum ditentukan';
    }
}
