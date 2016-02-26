<html>
	<body>
		@foreach($users as $user)
			@include('pdf.user')
			<div class="page-break"></div>
		@endforeach
	</body>
</html>