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
    	return $this->belongsToMany('\App\Tree','tags_node');
    }

    public function risks()
    {
        return $this->belongsToMany('\App\Risk','tags_node');
    }
}
