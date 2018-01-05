<nav class="ui inverted segment" style="border-radius:0">
    <div class="ui container">
        <div class="ui inverted secondary pointing menu">
            <!-- Branding Image -->
            <a class="active item" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <a href="/forum" class="item">Forum</a>
            @auth
            <div class="ui dropdown item">
                Add<i class="dropdown icon"></i>
            
                <div class="menu">
                    <a href="/article/create" class="item">Article</a>
                    <a href="/topic/create" class="item">Topic</a>
                </div>
            </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="right item">Login</a>
                <a href="{{ route('register') }}" class="item">Register</a>
            @else
                <div class="ui top right pointing dropdown item">
                    {{ Auth::user()->name }} &nbsp;
                    <img class="ui avatar image" src="{{ auth()->user()->getAvatar() }}" alt="Yehuda" style="border:1px solid #ddd"> <i class="dropdown icon"></i>

                    <div class="menu">
                        <a href="/user/{{ auth()->user()->username }}" class="item">Profile</a>
                        <a href="/settings" class="item">Settings</a>
                        <a href="{{ route('logout') }}" class="item"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endguest   
        </div>         
    </div>
</nav>