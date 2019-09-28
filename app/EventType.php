<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='event_types';
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function event_detail(){
        return $this->hasMany('App\EventDetail'); 
    }
}
