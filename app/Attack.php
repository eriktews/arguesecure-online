<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attack extends Node
{
    public $timestamps = true;
    
    protected $fillable = ['title','description', 'text'];

    /**
     * Relationships
     */
    
    public function tree()
    {
    	return $this->risk->tree();
    }

    public function risk()
    {
    	return $this->belongsTo('\App\Risk');
    }

    public function defences()
    {
        return $this->belongsToMany('\App\Defence');
    }

    public function parent()
    {
        return $this->risk;
    }

    public function siblings()
    {
        return $this->risk->attacks;
    }

    /**
     * Helpers
     */
    
    public function children()
    {
        return $this->defences();
    }

    public function getParentIdAttribute()
    {
        return $this->risk->id;
    }

    public function getIsDeletableAttribute()
    {
        $children = $this->children;
        foreach($children as $child)
        {
            if ( !$child->is_deletable)
                return false;
        }
        return !$this->locked;
    }

}
