<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Argue Secure">
  <meta name="author" content="">
  <title>Argue Secure - Export</title>
</head>
<body>
{{$tree->title}}  
<ul>
	@foreach($tree->risks as $risk)
	<li>
		{{$risk->title}}
		<ul>
			@foreach($risk->attacks as $attack)
			<li>
				{{$risk->title}}
				<ul>
				@foreach($attack->defences as $defence)
					<li>{{$defence->title}}</li>
				@endforeach
				</ul>
			</li>
			@endforeach
		</ul>
	</li>
	@endforeach
</ul>
</body>
</html>