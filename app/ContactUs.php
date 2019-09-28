<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $table='contact_uses';

    protected $fillable = ['office','address','cell','email'];

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
