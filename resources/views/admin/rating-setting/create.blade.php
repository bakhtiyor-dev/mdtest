@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.rating-setting.actions.create'))

@section('body')

    <div class="container-xl">

        <a href="{{url()->previous()}}" class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle mr-1"></i>
            Назад
        </a>

        <div class="card">

            <rating-setting-form
                    :action="'{{ url('admin/rating-settings') }}'"
                    :locales="{{ json_encode($locales) }}"
                    :send-empty-locales="false"
                    v-cloak
                    inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.rating-setting.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.rating-setting.components.form-elements')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </rating-setting-form>

        </div>

    </div>


@endsection