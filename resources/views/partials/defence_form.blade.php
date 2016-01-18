<div class="form-group form-material">
 	<label class="control-label" for="tree-title">Title</label>
 	{!! Form::text('title', null, ['class'=>'form-control', 'id'=>"tree-title"]) !!}
</div>

<div class="form-group form-material">
 	<label class="control-label" for="tree-description">Description</label>
 	{!! Form::text('description', null, ['class'=>'form-control', 'id'=>"tree-description"]) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="tree-text">Text</label>
 	{!! Form::textarea('text', null, ['class'=>'form-control', 'id'=>"tree-text", 'rows'=>'3']) !!}
</div>

<div class="form-group form-material">
  	<label class="control-label" for="defence-attacks">Attacks</label>
  	{!! Form::select('attacks[]', $attack->tree->attacks->pluck('title','id')->toArray(), array_unique(array_merge($defence->attacks->pluck('id')->toArray(), [$attack->id])), ['class'=>'form-control', 'id'=>"defence-attacks", 'data-plugin'=>'select2', 'multiple']) !!}
</div>

{!!Form::hidden('tree',$attack->tree->id)!!}