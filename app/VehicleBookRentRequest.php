<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBookRentRequest extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='vehicle_book_rent_requests';
    protected $fillable = ['name','mobile','email','journey_date','return_date','description','vehicle_amount','vehicle_type_id','route_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
   
     public function route(){

        return $this->belongsTo('App\Route','route_id','id'); 
    }

    public function vehicle_type(){

        return $this->belongsTo('App\VehicleType','vehicle_type_id','id'); 
    }
}
