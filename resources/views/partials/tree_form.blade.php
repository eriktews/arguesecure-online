<div class="form-group form-material">
  	<label class="control-label" for="tree-public">Public</label>
	{!! Form::hidden('public', 0) !!}
 	{!! Form::checkbox('public', 1, null, ['id'=>'tree-public','data-plugin'=>'switchery']) !!}
</div>

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

{{-- <div class="form-group form-material">
  	<label class="control-label" for="tree-tags">Tags</label>
  	{!! Form::select('tags[]', \App\Tag::all()->pluck('title','slug')->toArray(), $tree->tags->pluck('title','slug')->toArray(), ['class'=>'form-control', 'id'=>"tree-tags", 'data-plugin'=>'select2', 'data-select2-tags'=>'true', 'multiple']) !!}
</div>
 --}}