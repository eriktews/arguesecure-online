@if(Auth::check())
<script>
window.arsec = window.arsec || {};
arsec.user = {!!Auth::user()!!};
</script>
@endif