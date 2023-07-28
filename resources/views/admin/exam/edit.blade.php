@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.exam.actions.edit', ['name' => $exam->id]))

@section('body')

    <div class="container-xl">
        <a href="{{url()->previous()}}" class="btn btn-primary mb-2">
            <i class="icon icon-arrow-left-circle mr-1"></i>
            Назад
        </a>
        <div class="card">
            <exam-form
                    :action="'{{ $exam->resource_url }}'"
                    :data="{{ $exam->toJson() }}"
                    :locales="{{ json_encode($locales) }}"
                    :send-empty-locales="false"
                    v-cloak
                    inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action"
                      novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.exam.actions.edit', ['name' => $exam->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.exam.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

            </exam-form>

        </div>

    </div>

@endsection