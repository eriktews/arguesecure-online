<html>
	<head>
  		<link rel="stylesheet" href="{{asset('css/app.css')}}">
	</head>
	<body>
		@foreach($users as $user)
			@include('pdf.user')
			<div class="page-break"></div>
		@endforeach
	</body>
</html>