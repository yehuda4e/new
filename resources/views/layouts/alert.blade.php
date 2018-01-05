@if (Session::has('info'))
<div class="ui positive compact message alert" role="alert">
	<i class="close icon"></i>
	<div class="header">
		Info
	</div>
	<p>{{ Session::get('info') }}</p>
</div>
@endif