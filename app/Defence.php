<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defence extends Node
{
    public $timestamps = true;

    public $tempAttacks = null;
    
    protected $fillable = ['title','description', 'text', 'tree_id'];

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

    public function attacks()
    {
        return $this->belongsToMany('\App\Attack');
    }

    public function getParentAttribute()
    {
        return $this->attacks->first();
    }

    public function getAttackAttribute()
    {
        return $this->attacks->first();
    }

    /**
     * Helpers
     */
    
    public function getChildrenAttribute()
    {
        return new \Illuminate\Database\Eloquent\Collection;
    }

    public function getParentIdAttribute()
    {
        return $this->parent->id;
    }

    public function getIsDeletableAttribute()
    {
        return !$this->locked;
    }

}
