<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="navbar-header ">
        <ul class="nav navbar-nav flex-row ">
            <li class="nav-item mr-auto ">
                <a class="navbar-brand " href="/">
                    <img src="{{asset('images/plane.png')}}" class="" style="height: 40px" alt="logo">
                    <span style="font-weight: bold">MDTEST</span>
                </a>
            </li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item mb-1 {{Route::is('exams.available')?'active':''}}">
                <a href="{{route('exams.available')}}">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-title">Доступные экзамены</span>
                </a>
            </li>

            <li class="nav-item {{Route::is('exams.expired')?'active':''}}">
                <a href="{{route('exams.expired')}}" title="Просроченные экзамены">
                    <i class="fas fa-calendar-times"></i>
                    <span class="menu-title">Просроченные экзамены</span>
                </a>
            </li>

        </ul>
    </div>
</div>
