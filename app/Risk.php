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

    public function parent()
    {
        return $this->tree;
    }

    public function attacks()
    {
        return $this->hasMany('\App\Attack');
    }

    /**
     * Helpers
     */
    
    public function children()
    {
        return $this->attacks();
    }

    public function getParentIdAttribute()
    {
        return $this->tree->id;
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
