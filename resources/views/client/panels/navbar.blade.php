<nav
        class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-light navbar-shadow">

    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i></a>
                        </li>
                        <li class="nav-item mobile-menu d-xl-none mr-auto"></li>
                    </ul>
                    <h4>@yield('title'):</h4>
                </div>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-user nav-item">

                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">

                            <div class="user-nav d-sm-flex d-none">
                                <h5>  {{ auth()->user()->fullname }}</h5>
                            </div>

                            <span>
                <img class="round" src="{{url('images/default-avatar.svg')}}" alt="avatar" height="40" width="40"/>
              </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <form id="logout-form" action="{{route('logout')}}" method="POST">
                                @csrf
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-sign-out-alt"></i> Выйти
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


