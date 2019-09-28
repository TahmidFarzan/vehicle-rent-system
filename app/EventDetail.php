<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='event_details';

    protected $fillable = ['name','event_type_id','descriptaion','start_time','start_date','end_time','end_date','organizar','address','map','patner','image_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

     public function admin(){

        return $this->belongsTo('App\Admin'); 
    }

    public function event_type(){

        return $this->belongsTo('App\EventType'); 
    }

}
