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
<p>{{$tree->title}}</p>
<p>{{$tree->description}}</p>
<ul>
	@foreach($tree->risks as $risk)
	<li>
		<p>{{$risk->title}}</p>
		<p>{{$risk->description}}</p>
		<ul>
			@foreach($risk->attacks as $attack)
			<li>
				<p>{{$attack->title}}</p>
				<p>{{$attack->description}}</p>
				<ul>
				@foreach($attack->defences as $defence)
					<li>
						<p>{{$defence->title}}</p>
						<p>{{$attack->description}}</p>
					</li>
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