<div class="form-group row align-items-center">
    <label for="organisation" class="col-form-label text-md-right col-lg-2">Подразделение</label>
    <div class="col-lg-6">
        <v-select v-validate="'required'"
                  data-vv-name="organisation"
                  data-vv-as="подразделение"
                  :options="{{$organisations->toJson()}}"
                  label="title"
                  v-model="form.organisation_id"
                  :reduce="function(option){return option.id}"></v-select>

        <div v-if="errors.has('organisation')" class="form-control-feedback text-danger font-weight-bold form-text"
             v-cloak>
            @{{ errors.first('organisation') }}
        </div>
    </div>

</div>

<div class="form-group row align-items-center">
    <label for="department" class="col-form-label text-md-right col-lg-2">Отдел</label>
    <div class="col-lg-6">
        <v-select v-validate="'required'"
                  data-vv-name="department"
                  data-vv-as="отдел"
                  :options="{{$departments->toJson()}}"
                  label="title"
                  v-model="form.department_id"
                  :reduce="function(option){ return option.id}"></v-select>

        <div v-if="errors.has('department')" class="form-control-feedback text-danger font-weight-bold form-text"
             v-cloak>
            @{{ errors.first('department') }}
        </div>
    </div>

</div>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam.columns.title') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.title" v-validate="'required'" data-vv-as="название" id="title"
                      name="title"></textarea>
        </div>
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('title') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('start_date'), 'has-success': fields.start_date && fields.start_date.valid }">
    <label for="start_date" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam.columns.start_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.start_date" :config="datetimePickerConfig"
                      v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'"
                      data-vv-as="дата начала" class="flatpickr"
                      :class="{'form-control-danger': errors.has('start_date'), 'form-control-success': fields.start_date && fields.start_date.valid}"
                      id="start_date" name="start_date"
                      placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('start_date')" class="form-control-feedback form-text" v-cloak>
            @{{errors.first('start_date') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('end_date'), 'has-success': fields.end_date && fields.end_date.valid }">
    <label for="end_date" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam.columns.end_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.end_date" :config="datetimePickerConfig"
                      v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'"
                      data-vv-as="дата окончания" class="flatpickr"
                      :class="{'form-control-danger': errors.has('end_date'), 'form-control-success': fields.end_date && fields.end_date.valid}"
                      id="end_date" name="end_date"
                      placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('end_date')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('end_date')}}
        </div>
    </div>
</div>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('time'), 'has-success': fields.time && fields.time.valid }">
    <label for="time" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam.columns.time') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.time" v-validate="'required|integer'" data-vv-as="время"
               @input="validate($event)"
               class="form-control"
               min="0"
               :class="{'form-control-danger': errors.has('time'), 'form-control-success': fields.time && fields.time.valid}"
               id="time" name="time" placeholder="{{ trans('admin.exam.columns.time') }}">
        <div v-if="errors.has('time')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('time') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('attempts_count'), 'has-success': fields.attempts_count && fields.attempts_count.valid }">
    <label for="attempts_count" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.exam.columns.attempts_count') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.attempts_count" v-validate="'required|integer'" data-vv-as="кол-во попыток"
               @input="validate($event)"
               class="form-control"
               min="1"
               :class="{'form-control-danger': errors.has('attempts_count'), 'form-control-success': fields.attempts_count && fields.attempts_count.valid}"
               id="attempts_count" name="attempts_count" placeholder="{{ trans('admin.exam.columns.attempts_count') }}">
        <div v-if="errors.has('attempts_count')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('attempts_count') }}
        </div>
    </div>
</div>


<div class="form-group row align-items-center">
    <label for="rating_setting" class="col-form-label text-md-right col-lg-2">Шкала оценивания</label>
    <div class="col-lg-6">
        <v-select v-validate="'required'"
                  data-vv-name="rating_setting"
                  data-vv-as="шкала оценивания"
                  :options="{{$ratingSettings->toJson()}}" label="title"
                  v-model="form.rating_setting_id" :reduce="function(option){ return option.id}"></v-select>
        <div v-if="errors.has('rating_setting')" class="form-control-feedback text-danger font-weight-bold form-text"
             v-cloak>
            @{{ errors.first('rating_setting') }}
        </div>
    </div>

</div>


<div class="form-check row"
     :class="{'has-danger': errors.has('can_complete_untill_all_answered'), 'has-success': fields.can_complete_untill_all_answered && fields.can_complete_untill_all_answered.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="can_complete_untill_all_answered" type="checkbox"
               v-model="form.can_complete_untill_all_answered" v-validate="''"
               data-vv-name="can_complete_untill_all_answered" name="can_complete_untill_all_answered_fake_element">
        <label class="form-check-label" for="can_complete_untill_all_answered">
            {{ trans('admin.exam.columns.can_complete_untill_all_answered') }}
        </label>
        <input type="hidden" name="can_complete_untill_all_answered" :value="form.can_complete_untill_all_answered">
        <div v-if="errors.has('can_complete_untill_all_answered')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('can_complete_untill_all_answered') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('can_return_to_passed_question'), 'has-success': fields.can_return_to_passed_question && fields.can_return_to_passed_question.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="can_return_to_passed_question" type="checkbox"
               v-model="form.can_return_to_passed_question" v-validate="''" data-vv-name="can_return_to_passed_question"
               name="can_return_to_passed_question_fake_element">
        <label class="form-check-label" for="can_return_to_passed_question">
            {{ trans('admin.exam.columns.can_return_to_passed_question') }}
        </label>
        <input type="hidden" name="can_return_to_passed_question" :value="form.can_return_to_passed_question">
        <div v-if="errors.has('can_return_to_passed_question')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('can_return_to_passed_question') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('can_skip_question'), 'has-success': fields.can_skip_question && fields.can_skip_question.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="can_skip_question" type="checkbox" v-model="form.can_skip_question"
               v-validate="''" data-vv-name="can_skip_question" name="can_skip_question_fake_element">
        <label class="form-check-label" for="can_skip_question">
            {{ trans('admin.exam.columns.can_skip_question') }}
        </label>
        <input type="hidden" name="can_skip_question" :value="form.can_skip_question">
        <div v-if="errors.has('can_skip_question')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('can_skip_question') }}
        </div>
    </div>
</div>


<div class="form-check row"
     :class="{'has-danger': errors.has('enable_explanation'), 'has-success': fields.enable_explanation && fields.enable_explanation.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="enable_explanation" type="checkbox" v-model="form.enable_explanation"
               v-validate="''" data-vv-name="enable_explanation" name="enable_explanation_fake_element">
        <label class="form-check-label" for="enable_explanation">
            {{ trans('admin.exam.columns.enable_explanation') }}
        </label>
        <input type="hidden" name="enable_explanation" :value="form.enable_explanation">
        <div v-if="errors.has('enable_explanation')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('enable_explanation') }}
        </div>
    </div>
</div>

<hr>

<div>
    <label>Выбрать тесты (категории и кол-во):</label>
    <test-category-count :test_categories="{{$testCategories->toJson()}}"
                         v-model="form.test_category_count"></test-category-count>
</div>


