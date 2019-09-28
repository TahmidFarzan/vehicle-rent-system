<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBookRent extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='event_book_rents';
    protected $fillable = ['name','mobile','email','description','ticket_amount','vehicle_amount','vehicle_type_id','event_detail_id','price'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
   public function admin(){

        return $this->belongsTo('App\Admin'); 
    }
    
     public function event_detail(){

        return $this->belongsTo('App\EventDetail','event_detail_id','id'); 
    }

    public function vehicle_type(){

        return $this->belongsTo('App\VehicleType','vehicle_type_id','id'); 
    }
}
