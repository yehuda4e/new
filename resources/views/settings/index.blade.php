@extends('layouts.app')

@section('content')
<div class="ui segments">
	<div class="ui segment">
		<h3 class="header">Settings</h3>
	</div>	
</div>

<div class="ui top attached tabular menu">
	<a href="#" data-tab="index" class="active item">Personal Info</a>
	<a href="#" data-tab="password" class="item">Change Password</a>
	<a href="#" data-tab="inbox" class="item">inbox</a>
	<a href="#" data-tab="avatar" class="item">Avatar &amp; Cover</a>
	<a href="#" data-tab="signature" class="item">Signature</a>
</div>

<div class="ui bottom attached tab segment" data-tab="index">
	@include('settings.general')
</div>
<div class="ui bottom attached tab segment" data-tab="password">
	@include('settings.password')
</div>
<div class="ui bottom attached tab segment" data-tab="avatar">
	@include('settings.avatar')
</div>
<div class="ui bottom attached tab segment" data-tab="inbox">
	@include('settings.inbox')
</div>
<div class="ui bottom attached tab segment" data-tab="signature">
	@include('settings.signature')
</div>
@stop

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
<script>
$('.ui.checkbox').checkbox()
$('.tabular.menu .item').tab({
	history: true,
});	
</script>
@endpush