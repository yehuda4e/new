@extends('layouts.app')

@section('content')
<div class="ui piled segments">
    <div class="ui segment">
        <h3 class="header">Reset Password</h3>
    </div>
    <div class="ui teal segment">
        <form class="ui form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="required field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="required field{{ $errors->has('password') ? ' error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="required field{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="field">
                <button type="submit" class="ui primary button">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
