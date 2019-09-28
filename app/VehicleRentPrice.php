<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleRentPrice extends Model
{
             /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='vehicle_rent_prices';

    protected $fillable = ['total_price','rent_price','distance_price','vehicle_type_id','route_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

     public function admin(){

        return $this->belongsTo('App\Admin'); 
    }

    public function route(){

        return $this->belongsTo('App\Route','route_id','id'); 
    }

    public function vehicle_type(){

        return $this->belongsTo('App\VehicleType','vehicle_type_id','id'); 
    }
}
