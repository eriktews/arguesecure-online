<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\TreeObserver;

class Tree extends Model
{
    public $timestamps = true;

    protected $fillable = ['title', 'description', 'text', 'public'];

    /**
     * Query Scopes
     */
    
    /**
     * Scope a query to only include visible trees.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->distinct()->where('public', '=', 1)->orWhere('user_id','=',auth()->user()->id)->with('user');
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

}
