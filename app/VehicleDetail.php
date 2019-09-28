<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleDetail extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='vehicle_details';

    protected $fillable = ['name','type_id','seat','licence_no','image_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

     public function admin(){

        return $this->belongsTo('App\Admin'); 
    }

    public function vehicle_type(){

        return $this->belongsTo('App\VehicleType','type_id','id'); 
    }

   
}
