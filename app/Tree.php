<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\TreeObserver;

use Auth;

class Tree extends Model
{
    public $timestamps = true;

    protected $fillable = ['name', 'is_public'];

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

}
