<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attack extends Model
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

    public function updatedBy()
    {
    	return $this->belongsTo('\App\User','updated_by');
    }

    public function parent()
    {
        return $this->risk;
    }

    /**
     * Helpers
     */
    
    public function getParentIdAttribute()
    {
        return $this->risk->id;
    }
    
    public function getChildrenAttribute()
    {
        return new \Illuminate\Database\Eloquent\Collection;
    }

    public function getIsDeletableAttribute()
    {
        // $children = $this->children;
        // foreach($children as $child)
        // {
        //     if ( !$child->is_deletable)
        //         return false;
        // }
        return !$this->locked;
    }

    //Does NOT save
    public function lock()
    {
        $this->lock_time = time() + env('LOCK_TIME', 30);
        $this->locked = 1;
    }

    public function unlock()
    {
        $this->locked = 0;
    }


}
