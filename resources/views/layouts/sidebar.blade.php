@php
$c = Request::segment(1);
$m = Request::segment(2);
$roleName = Auth::user()->getRoleNames();
@endphp

<aside class="main-sidebar elevation-4 sidebar-light-info">
    <a href="{{ route('posts.index')  }}" class="brand-link navbar-info">
        <img src="{{ asset('assets/images/favicon.ico') }}" alt="{{ $applicationSetting->item_name }}" class="brand-image" style="opacity: .8; width :32px; height : 32px">
        <span class="brand-text font-weight-light">{{ $applicationSetting->item_name }}</span>
    </a>
    <div class="sidebar">
        @php
            $photo = (Auth::user()->photo == NULL) ? ("img/profile/male.png") : (Auth::user()->photo);
        @endphp
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset($photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info my-auto">
                {{ Auth::user()->name }}
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link @if($c == 'posts') active @endif">
                        <i class="nav-icon far fa-paper-plane"></i>
                        <p>@lang('All Posts')</p>
                    </a>
                </li>
                @canany(['user-read', 'user-create', 'user-update', 'user-delete', 'user-export'])
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link @if($c == 'users') active @endif ">
                            <i class="fa fa-users nav-icon"></i>
                            <p>@lang('Users Management')</p>
                        </a>
                    </li>
                @endcanany
                @canany(['role-read', 'role-create', 'role-update', 'role-delete'])
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link @if($c == 'roles') active @endif ">
                            <i class="fas fa-cube nav-icon"></i>
                            <p>@lang('Plan Management')</p>
                        </a>
                    </li>
                @endcanany
                @if ($roleName['0'] = "Super Admin")
                    <li class="nav-item">
                        <a href="{{ route('apsetting') }}" class="nav-link @if($c == 'apsetting' && $m == null) active @endif ">
                            <i class="fa fa-globe nav-icon"></i>
                            <p>@lang('Application Settings')</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
