<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defence extends Model
{
    public $timestamps = true;
    
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
