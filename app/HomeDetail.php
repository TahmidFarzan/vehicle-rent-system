<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='home_details';
    protected $fillable = ['description'];

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
