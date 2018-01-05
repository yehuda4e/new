<form method="post" action="/settings/password" class="ui form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}

	<h4 class="ui dividing header">Change Password</h4>

	<div class="field {{ $errors->has('old_password') ? ' error' : '' }}">
		<label for="old_password">Old Password</label>
		<div class="ui left icon input">
			<input type="password" name="old_password" id="old_password" placeholder="Enter your password">
			<i class="key icon"></i>
		</div>

        @if ($errors->has('old_password'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('old_password') }}</strong>
            </span>
        @endif	
	</div>

	<div class="field {{ $errors->has('new_password') ? ' error' : '' }}">
		<label for="new_password">New Password</label>
		<div class="ui left icon input">
			<input type="password" name="new_password" id="new_password" placeholder="Enter your password">
			<i class="key icon"></i>
		</div>

		@if ($errors->has('new_password'))
			<span class="ui visible error message">
				<strong>{{ $errors->first('new_password') }}</strong>
			</span>
		@endif
	</div>

	<div class="field {{ $errors->has('new_password_confirmation') ? ' error' : '' }}">
		<label for="new_password_confirmation">Confirm New Password</label>
		<div class="ui left icon input">
			<input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Enter your password">
			<i class="key icon"></i>
		</div>
	</div>

	<div class="field">
		<button class="ui primary button">Update</button>
	</div>
</form>