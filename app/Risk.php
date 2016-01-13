<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    public $timestamps = true;
    
    protected $fillable = ['title','description', 'text'];

    /**
     * Relationships
     */
    
    public function tree()
    {
    	return $this->belongsTo('\App\Tree');
    }

    public function updatedBy()
    {
    	return $this->belongsTo('\App\User','updated_by');
    }

    /**
     * Helpers
     */
    
    public function getChildrenAttribute()
    {
        return [];
    }

}
