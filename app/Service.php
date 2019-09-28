<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='services';
    protected $fillable = ['name','image_name','description'];

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
