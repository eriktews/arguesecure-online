<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\TagVisibleScope;

class Tag extends Model
{
    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'color'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TagVisibleScope);
    }

    /**
     * Relationships
     */

    public function trees()
    {
    	return $this->morphByMany('\App\Tree','taggable');
    }

    public function risks()
    {
        return $this->morphByMany('\App\Risk','taggable');
    }

    public function attacks()
    {
        return $this->morphByMany('\App\Attack','taggable');
    }

    public function defences()
    {
        return $this->morphByMany('\App\Defence','taggable');
    }
}
