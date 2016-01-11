<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CategoryVisibleScope;

class Category extends Model
{
    public $timestamps = true;

    protected $fillable = ['title', 'slug'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CategoryVisibleScope);
    }

    /**
     * Relationships
     */

    public function trees()
    {
    	return $this->belongsToMany('\App\Tree');
    }
}
