@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.test-category.actions.edit', ['name' => $testCategory->title]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <test-category-form
                :action="'{{ $testCategory->resource_url }}'"
                :data="{{ $testCategory->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.test-category.actions.edit', ['name' => $testCategory->title]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.test-category.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </test-category-form>

        </div>
    
</div>

@endsection