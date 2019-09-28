<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='home_sliders';
    protected $fillable = ['slider_name','slider_url','slider_alt','slider_sequence'];

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
