@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.department.actions.edit', ['name' => $department->title]))

@section('body')

    <div class="container-xl">
        <a href="{{url('/admin/departments')}}" class="btn btn-primary mb-2">
            <i class="fa fa-arrow-circle-left"></i>
            Назад
        </a>

        <div class="card">

            <department-form
                :action="'{{ $department->resource_url }}'"
                :data="{{ $department->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.department.actions.edit', ['name' => $department->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.department.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </department-form>

        </div>
    
</div>

@endsection