<form method="post" action="/settings" class="ui form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}

	<!-- Personal Info -->
	<h4 class="ui dividing header">Personal Info</h4>
	<!-- First & Last name -->
	<div class="two fields">
		<div class="field {{ $errors->has('first_name') ? ' error' : '' }}">
			<label for="first_name">First Name</label>
			<div class="ui left icon input">
				<input type="text" name="first_name" id="first_name" value="{{ old('first_name') ?? $user->first_name }}" placeholder="First Name">
				<i class="user circle icon"></i>
			</div>

            @if ($errors->has('first_name'))
                <span class="ui visible error message">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif				
		</div>
		<div class="field {{ $errors->has('last_name') ? ' error' : '' }}">
			<label for="last_name">Last Name</label>
			<div class="ui left icon input">
				<input type="text" name="last_name" id="last_name" value="{{ old('last_name') ?? $user->last_name }}" placeholder="Last Name">
				<i class="user circle outline icon"></i>
			</div>

            @if ($errors->has('last_name'))
                <span class="ui visible error message">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif				
		</div>		
	</div>
	<!-- About -->
	<div class="field {{ $errors->has('about') ? ' error' : '' }}">
		<label for="about">About</label>
		<div class="ui left icon input">
			<input type="text" name="about" id="about" value="{{ old('about') ?? $user->about }}" placeholder="Tell something about yourself..">
			<i class="id card icon"></i>
		</div>

        @if ($errors->has('about'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('about') }}</strong>
            </span>
        @endif				
	</div>
	<!-- Location -->
	<div class="field {{ $errors->has('location') ? ' error' : '' }}">
		<label for="location">Location</label>
		<div class="ui left icon input">
			<input type="text" name="location" id="location" value="{{ old('location') ?? $user->location }}" placeholder="Location">
			<i class="marker icon"></i>
		</div>

        @if ($errors->has('location'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif				
	</div>		
	<!-- Sex -->
	<div class="inline fields {{ $errors->has('sex') ? ' error' : '' }}">
		<label>Sex</label>
		<div class="field">
			<div class="ui radio checkbox">
				<label for="none"><i class="genderless icon" title="Genderless"></i></label>
				<input type="radio" name="sex" id="sex" value="none" {{ ($user->sex === 'none') ? 'checked' : '' }}>
			</div>
		</div>			
		<div class="field">
			<div class="ui radio checkbox">
				<label for="male"><i class="male icon" title="Male"></i></label>
				<input type="radio" name="sex" id="sex" value="male" {{ ($user->sex === 'male') ? 'checked' : '' }}>
			</div>
		</div>
		<div class="field">
			<div class="ui radio checkbox">
				<label for="female"><i class="female icon" title="Female"></i></label>
				<input type="radio" name="sex" id="sex" value="female" {{ ($user->sex === 'female') ? 'checked' : '' }}>
			</div>
		</div>	

        @if ($errors->has('sex'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('sex') }}</strong>
            </span>
        @endif	
	</div>	
	<!-- Birthday -->
	<div class="field {{ $errors->has('birthday') ? ' error' : '' }}">
		<label for="birthday">Birth Day</label>
		<div class="ui left icon input">
			<input type="date" name="birthday" id="birthday" value="{{ old('birthday') ?? $user->birthday }}">
			<i class="birthday icon"></i>
		</div>

        @if ($errors->has('birthday'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('birthday') }}</strong>
            </span>
        @endif				
	</div>		
	</fieldset>

	<!-- Contact Info -->
	<h4 class="ui dividing header">Contact Info</h4>
	<div class="required field {{ $errors->has('email') ? ' error' : '' }}">
		<label for="email">Email</label>
		<div class="ui left icon input">
			<input type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}" placeholder="Your Email address" required>
			<i class="mail icon"></i>
		</div>

        @if ($errors->has('email'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif				
	</div>
	<div class="three fields">
		<div class="field {{ $errors->has('facebook') ? ' error' : '' }}">
			<label for="facebook">Facebook</label>
			<div class="ui left icon input">
				<input type="text" name="facebook" id="facebook" value="{{ old('facebook') ?? $user->facebook }}" placeholder="facebook username" accesskey="f">
				<i class="blue facebook icon"></i>
			</div>

            @if ($errors->has('facebook'))
                <span class="ui visible error message">
                    <strong>{{ $errors->first('facebook') }}</strong>
                </span>
            @endif					  
		</div>
		<div class="field {{ $errors->has('twitter') ? ' error' : '' }}">
			<label for="twitter">Twitter</label>
			<div class="ui left icon input">
				<input type="text" name="twitter" id="twitter" value="{{ old('twitter') ?? $user->twitter }}" placeholder="@username">
				<i class="teal twitter icon"></i>
			</div>			

            @if ($errors->has('twitter'))
                <span class="ui visible error message">
                    <strong>{{ $errors->first('twitter') }}</strong>
                </span>
            @endif					
		</div>
		<div class="field {{ $errors->has('youtube') ? ' error' : '' }}">
			<label for="youtube">Youtube</label>
			<div class="ui left icon input">
				<input type="text" name="youtube" id="youtube" value="{{ old('youtube') ?? $user->youtube }}" placeholder="Youtube channel name">
				<i class="red youtube play icon"></i>
			</div>			

            @if ($errors->has('youtube'))
                <span class="ui visible error message">
                    <strong>{{ $errors->first('youtube') }}</strong>
                </span>
            @endif					
		</div>
	</div>
	<div class="field {{ $errors->has('website') ? ' error' : '' }}">
		<label for="website">Website</label>
		<div class="ui left icon input">
			<input type="url" name="website" id="website" value="{{ old('website') ?? $user->website }}" placeholder="your personal website">
			<i class="hashtag icon"></i>
		</div>

        @if ($errors->has('website'))
            <span class="ui visible error message">
                <strong>{{ $errors->first('website') }}</strong>
            </span>
        @endif				
	</div>

	<div class="field">
		<button class="ui primary button">Update</button>
	</div>
</form>