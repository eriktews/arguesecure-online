<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\TreeObserver;
use App\Scopes\TreeVisibleScope;

class Tree extends Model
{
    public $timestamps = true;

    protected $fillable = ['title', 'description', 'text', 'public'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TreeVisibleScope);
    }

    /**
     * Relationships
     */

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }

    public function updatedBy()
    {
    	return $this->belongsTo('\App\User','updated_by');
    }

    public function categories()
    {
        return $this->belongsToMany('\App\Category');
    }

    public function risks()
    {
        return $this->hasMany('\App\Risk');
    }

    /**
     * Helpers
     */
    
    public function getChildrenAttribute()
    {
        return $this->risks;
    }
    
    public function getShouldUnlockAttribute()
    {
        return $this->lock_time < time();
    }

    public function isDeletable()
    {

    }
    
    //Does NOT save
    public function lock()
    {
        $this->lock_time = time() + env('LOCK_TIME', 30);
        $this->locked = true;
    }

    public function unlock()
    {
        $this->locked = false;
    }

}
