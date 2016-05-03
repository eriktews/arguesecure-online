<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\TagEvents\TagAttached;
use DB;

class Node extends Model
{
    public $timestamps = true;

    protected $with = ['updatedBy'];

    public function updatedBy()
    {
        return $this->belongsTo('\App\User','updated_by');
    }

    public function getShouldUnlockAttribute()
    {
        return $this->lock_time < time();
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable')->orderBy('slug');
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

    public function children()
    {
        return [];
    }

    public function syncTags($tags, $detaching = true)
    {
        $ids = [];

        if ( is_array($tags) )
        {
            $slugged = array_map('str_slug', $tags);

            //For each tag check if it exists, if so, then attach it, if not, create it
            foreach ($slugged as $key => $value) {
                if ($value != "") {
                    if (!$tag = \App\Tag::where('slug','=',str_slug($value))->first())
                    {
                        $tag = \App\Tag::create(['title'=>$tags[$key],'slug'=>$value]);
                    }
                    $ids[] = $tag->id;
                }
            }

        }

        $result = $this->tags()->sync($ids, $detaching);

        $this->pruneTags();

        return $result;

    }

    private function pruneTags()
    {
        $all_tags = \App\Tag::withoutGlobalScopes()->get()->pluck('id')->toArray();
        $used_tags = DB::table('taggables')->distinct()->lists('tag_id');
        $unused_tags = array_diff($all_tags,$used_tags);

        $instance = new static;

        $key = $instance->getKeyName();

        foreach (\App\Tag::withoutGlobalScopes()->whereIn($key, $unused_tags)->get() as $tag) {
            $tag->delete();
        }
    }

    public function getAllTagsAttribute()
    {
        return $this->getAllTags();
    }

    public function getAllTags()
    {
        $tags = $this->tags;

        foreach ($this->children as $child)
        {
            $tags = $tags->merge($child->getAllTags()); 
        }

        return $tags->sortBy('slug');
    }

}
