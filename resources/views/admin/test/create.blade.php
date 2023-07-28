@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.test.actions.create'))

@section('body')

    <div class="container-xl">
        <a href="{{url()->previous()}}" class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle mr-1"></i>
            Назад
        </a>
        <div class="card">

            <test-form
                    :action="'{{ url('admin/tests') }}'"
                    v-cloak
                    inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.test.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.test.components.form-elements')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </test-form>

        </div>

    </div>


@endsection