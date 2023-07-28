@extends('brackets/admin-ui::admin.layout.default')

@section('title', "Подключить пользователей")

@section('body')

    <a href="{{route('admin/exam-users/index',$exam)}}" class="btn btn-primary mb-3">
        <i class="fa fa-arrow-left"></i>
        Назад
    </a>

    <form class="form-horizontal form-create"
          method="post"
          action="{{route('admin/exam-users/store',$exam)}}">

        @csrf

        <user-listing
                :data="{{ $data->toJson() }}"
                :url="'{{ route('admin/exam-users/create',$exam) }}'"
                inline-template>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <input type="hidden" name="users" :value="JSON.stringify(bulkItems)">
                        <div class="card-header">
                            <h4 class="pull-left">
                                <i class="fa fa-user-plus"></i> Подключить пользователей
                            </h4>
                            <button type="submit" class="btn btn-primary pull-right"
                                    :disabled="clickedBulkItemsCount === 0">
                                <i class="fa fa-download"></i>
                                Подключить
                            </button>

                        </div>

                        <div class="card-body" v-cloak>
                            <div class="card-block pt-0">
                                <form @submit.prevent="">
                                    <div class="row mb-4">
                                        <div class="col-lg-5">
                                            <label>Поиск по всем полям:</label>

                                            <div class="input-group">
                                                <input class="form-control"
                                                       placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}"
                                                       v-model="search"
                                                       @keyup.enter="filter('search', $event.target.value)"/>
                                                <span class="input-group-append">
                                            <button type="button" class="btn btn-primary"
                                                    @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">



                                        <div class="col-lg-3">
                                            <label>Фильтр по должностям (по умолчанию все):</label>
                                            <v-select :options="{{$positions->toJson()}}"
                                                      @input="filter('position',$event)">
                                            </v-select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Фильтр по отделам (по умолчанию все):</label>
                                            <v-select :options="{{$departments->toJson()}}"
                                                      @input="filter('department',$event)">
                                            </v-select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Фильтр по подразделениям (по умолчанию все):</label>
                                            <v-select :options="{{$organisations->toJson()}}"
                                                      @input="filter('organisation',$event)">
                                            </v-select>
                                        </div>

                                        <div class="col"></div>

                                        <div class="col-lg-auto ">
                                            <label>Показать по:</label>
                                            <select class="form-control" v-model="pagination.state.per_page">

                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="100">100</option>

                                            </select>
                                        </div>


                                    </div>

                                </form>

                                <table class="table table-hover table-listing">
                                    <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox"
                                                   v-model="isClickedAll" v-validate="''" data-vv-name="enabled"
                                                   name="enabled_fake_element"
                                                   @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.user.columns.id') }}</th>
                                        <th is='sortable'
                                            :column="'fullname'">{{ trans('admin.user.columns.fullname') }}</th>
                                        <th is='sortable' :column="'email'">{{ trans('admin.user.columns.email') }}</th>

                                        <th is='sortable'
                                            :column="'position'">{{ trans('admin.user.columns.position') }}</th>
                                        <th is='sortable'
                                            :column="'department'">{{ trans('admin.user.columns.department') }}</th>
                                        <th is='sortable'
                                            :column="'organisation'">{{ trans('admin.user.columns.organisation') }}</th>
                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="9">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAll('/admin/users')"
                                                        v-if="(clickedBulkItemsCount < pagination.state.total)"> <i
                                                            class="fa"
                                                            :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span
                                                        class="text-primary">|</span> <a
                                                        href="#" class="text-primary"
                                                        @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                            </span>

                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id"
                                        :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox"
                                                   v-model="bulkItems[item.id]" v-validate="''"
                                                   :data-vv-name="'enabled' + item.id"
                                                   :name="'enabled' + item.id + '_fake_element'"
                                                   @click="onBulkItemClicked(item.id)"
                                                   :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                        <td>@{{ item.id }}</td>
                                        <td>@{{ item.fullname }}</td>
                                        <td>@{{ item.email }}</td>
                                        <td>@{{ item.position }}</td>
                                        <td>@{{ item.department }}</td>
                                        <td>@{{ item.organisation }}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="row" v-if="pagination.state.total > 0">
                                    <div class="col-sm">
                                        <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                    </div>
                                    <div class="col-sm-auto">
                                        <pagination></pagination>
                                    </div>
                                </div>

                                <div class="no-items-found" v-if="!collection.length > 0">
                                    <i class="icon-magnifier"></i>
                                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </user-listing>

    </form>

@endsection