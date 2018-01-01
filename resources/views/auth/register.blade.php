@extends('layouts.app')

@section('content')
<div class="ui piled segments">
    <div class="ui segment">
        <h3 class="header">Register</h3>
    </div>

    <div class="ui teal segment">
        <form class="ui form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="required field{{ $errors->has('username') ? ' error' : '' }}">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>

                @if ($errors->has('username'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="required field{{ $errors->has('name') ? ' error' : '' }}">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>

                @if ($errors->has('name'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="required field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

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

            <div class="required field">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div class="field">
                <button type="submit" class="ui primary button">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
