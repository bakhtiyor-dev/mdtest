<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/') }}"><i
                            class="nav-icon fa fa-line-chart"></i>Аналитика</a></li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/exam-user-attempts') }}"><i
                            class="nav-icon fa fa-info-circle"></i>Отчёты</a></li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/organisations') }}">
                    <i class="nav-icon fa fa-building"></i>
                    {{ trans('admin.organisation.title') }}
                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/departments') }}">
                    <i class="nav-icon fa fa-cubes"></i>
                    {{ trans('admin.department.title') }}</a>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i
                            class="nav-icon icon-people"></i> {{ trans('admin.user.title') }}</a></li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/exams') }}"><i
                            class="nav-icon icon-event"></i> {{ trans('admin.exam.title') }}</a></li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/test-categories') }}">
                    <i class="nav-icon fa fa-list"></i> {{ trans('admin.test-category.title') }}
                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/tests') }}"><i
                            class="nav-icon fa fa-list-alt"></i> {{ trans('admin.test.title') }}</a></li>


           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/rating-settings') }}">
                    <i class="nav-icon icon-settings"></i> {{ trans('admin.rating-setting.title') }}</a></li>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

