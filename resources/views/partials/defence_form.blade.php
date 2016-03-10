<div class="form-group form-material">
 	<label class="control-label" for="tree-title">Title</label>
 	{!! Form::text('title', null, ['class'=>'form-control', 'id'=>"tree-title"]) !!}
</div>

<div class="form-group form-material">
 	<label class="control-label" for="tree-description">Description</label>
 	{!! Form::text('description', null, ['class'=>'form-control', 'id'=>"tree-description"]) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="tree-text">Notes</label>
 	{!! Form::textarea('text', null, ['class'=>'form-control', 'id'=>"tree-text", 'rows'=>'3']) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="is_transfer">Is Transfer</label>
	{!! Form::hidden('is_transfer', 0) !!}
 	{!! Form::checkbox('is_transfer', 1, null, ['id'=>'is_transfer','data-plugin'=>'switchery']) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="defence-attacks">Defends Against</label>
  	{!! Form::select('attacks[]', $attack->tree->attacks->pluck('title','id')->toArray(), array_unique(array_merge($defence->attacks->pluck('id')->toArray(), [$attack->id])), ['class'=>'form-control', 'id'=>"defence-attacks", 'data-plugin'=>'select2', 'multiple']) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="defence-tags">Tags</label>
  	{!! Form::select('tags[]', \App\Tag::all()->pluck('title','slug')->toArray(), $defence->tags->pluck('slug')->toArray(), ['class'=>'form-control', 'id'=>"defence-tags", 'data-plugin'=>'select2', 'data-select2-tags'=>'true', 'multiple']) !!}
</div>

{!!Form::hidden('tree',$attack->tree->id)!!}