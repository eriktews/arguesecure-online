@if(Auth::check())
<script>
var arsec = {
	user: {!!Auth::user()!!}
}
</script>
@endif