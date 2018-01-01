@extends('layouts.app')

@section('content')
<div class="ui piled segments">
    <div class="ui segment">
        <h3 class="header">Reset Password</h3>
    </div>
    <div class="ui teal segment">
        @if (session('status'))
            <div class="ui visiable success message">
                {{ session('status') }}
            </div>
        @endif

        <form class="ui form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="required field{{ $errors->has('email') ? ' error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="field">
                <button type="submit" class="ui primary button">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
