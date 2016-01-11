<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TreeVisibleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check())
            return $builder->distinct()->where('public', '=', 1)->orWhere('user_id','=',auth()->user()->id)->with('user');
        return $builder->distinct()->where('public', '=', 1)->with('user');
    }
}