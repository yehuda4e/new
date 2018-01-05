<form method="post" action="/settings/avatar" class="ui form">
	{{ csrf_field() }}	
	{{ method_field('PATCH') }}

	<h4 class="ui dividing header">Avatar &amp; Cover</h4>
	<div class="field {{ $errors->has('avatar') ? ' error' : '' }}">
		<label for="avatar">Avatar</label>
		<div class="ui left icon input">
			<input type="url" name="avatar" id="avatar" value="{{ old('avatar') ?? $user->avatar }}" placeholder="Avatar URL">
			<i class="image icon"></i>
		</div>

		@if($errors->has('avatar'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('avatar') }}</strong>
            </span>
		@endif
	</div>

	<div class="field {{ $errors->has('cover') ? ' error' : '' }}">
		<label for="cover">Cover image</label>
		<div class="ui left icon input">
			<input type="url" name="cover" id="cover" value="{{ old('cover') ?? $user->cover }}" placeholder="Cover image URL">
			<i class="image icon"></i>
		</div>	

		@if($errors->has('cover'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('cover') }}</strong>
            </span>
		@endif		
	</div>

	<div class="field">
		<button class="ui primary button">Update</button>
	</div>
</form>