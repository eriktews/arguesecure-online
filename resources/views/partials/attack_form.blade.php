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
  	<label class="control-label" for="attack-tags">Tags</label>
  	{!! Form::select('tags[]', $risk->tree->all_tags->pluck('title','slug')->toArray(), ($attack->risk ? $attack->tags->pluck('slug')->toArray() : $risk->tags->pluck('slug')->toArray()), ['class'=>'form-control', 'id'=>"attack-tags", 'data-plugin'=>'select2', 'data-select2-tags'=>'true', 'multiple']) !!}
</div>