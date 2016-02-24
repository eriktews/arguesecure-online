<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\TreeObserver;
use App\Scopes\TreeVisibleScope;

class Tree extends Node
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

    public function risks()
    {
        return $this->hasMany('\App\Risk');
    }

    public function attacks()
    {
        return $this->hasManyThrough('\App\Attack','\App\Risk');
    }

    /**
     * Helpers
     */
    
    public function children()
    {
        return $this->risks();
    }

    //Hack to make everything run smooth on update
    public function getParentIdAttribute()
    {
        return $this->id;
    }

    /**
     * Fake $node->parent
     * @return [type] [description]
     */
    public function getParentAttribute()
    {
        return null;
    }

    public function getIsDeletableAttribute()
    {
        $children = $this->children;
        foreach($children as $child)
        {
            if ( !$child->is_deletable)
                return false;
        }
        return true;
    }

}
