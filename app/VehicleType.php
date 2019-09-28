<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='vehicle_types';
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}