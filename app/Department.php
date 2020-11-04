<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Nicolaslopezj\Searchable\SearchableTrait;

class Department extends Model 
{

    protected $table = 'departments';
    public $timestamps = true;
    protected $fillable = array('name','parent');

    public function parents()
    {
        return $this->hasMany('App\Department');
    }
    
   

}