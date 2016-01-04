<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = ['name'];

    public function trees()
    {
    	return $this->belongsToMany('\App\Tree');
    }
}
