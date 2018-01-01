@extends('layouts.app')

@section('content')
<div class="ui piled segments">
    <div class="ui segment">
        <h3 class="header">Login</h3>
    </div>

    <div class="ui teal segment">
        <form class="ui form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="required field {{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="required field {{ $errors->has('password') ? ' error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="ui error message">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="inline field">
                <div class="ui checkbox">
                    <input type="checkbox" name="remember" tabindex="0" {{ old('remember') ? 'checked' : '' }}> 
                    <label>Remember Me</label>
                </div>
            </div>

            <div class="field">
                <button type="submit" class="ui primary button">
                    Login
                </button>

                <a class="ui button" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </form>
    </div>
</div>
@endsection