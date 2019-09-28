<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPriceDetail extends Model
{
              /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='event_price_details';

    protected $fillable = ['total_price','vehicle_price','ticket_price','vehicle_type_id','event_detail_id'];

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
