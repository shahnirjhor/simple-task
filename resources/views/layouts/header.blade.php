<nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            @php
                $photo = (Auth::user()->photo == NULL) ? ("img/profile/male.png") : (Auth::user()->photo);
            @endphp
            <a class="dropdown-toggle profile-pic login_profile" data-toggle="dropdown" href="#">
                <img src="{{ asset($photo) }}" alt="user-img" width="36" class="img-circle">
                <b id="ambitious-user-name-id" class="hidden-xs">{{  strtok(Auth::user()->name, " ") }}</b>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dw-user-box">
                    <div class="u-img"><img src="{{ asset($photo) }}" alt="user" /></div>
                    <div class="u-text">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-muted" style="padding-bottom: 5px;">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="dropdown-divider"></div>

                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off mr-2"></i> @lang('Logout')</a>

                <form id="logout-form" class="ambitious-display-none" action="{{ route('logout') }}" method="POST">@csrf</form>
            </div>
        </li>
    </ul>
</nav>
