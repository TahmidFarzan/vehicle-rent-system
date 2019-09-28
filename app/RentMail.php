<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentMail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='rent_mails';
    protected $fillable = ['from','to','subject','message'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function admin(){

        return $this->belongsTo('App\Admin'); 
    }
}
