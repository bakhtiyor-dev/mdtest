<div class="form-group row align-items-center">
    <label for="category" class="col-form-label text-md-right col-lg-2">Категория</label>
    <div class="col-lg-6">

        <v-select :options="{{$categories->toJson()}}"
                  v-validate="'required'"
                  label="title"
                  v-model="form.category_id"
                  data-vv-name="category"
                  data-vv-as="категория"
                  :reduce="function (category){ return category.id}">
        </v-select>

        <div v-if="errors.has('category')" class="form-control-feedback text-danger font-weight-bold form-text"
             v-cloak>
            @{{ errors.first('category') }}
        </div>
    </div>

</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('body'), 'has-success': fields.body && fields.body.valid }">
    <label for="body" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.test.columns.body') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.body" v-validate="'required'" data-vv-as="вопрос" id="body" name="body"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('body')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('body') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('answers_type'), 'has-success': fields.answers_type && fields.answers_type.valid }">
    <label for="answers_type" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.test.columns.answers_type') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

        <select class="form-control" v-model="form.answers_type" data-vv-name="answers_type" data-vv-as="тип вопроса"
                v-validate="'required'">
            <option :value="answer_type.type" v-for="answer_type in answerTypes">@{{ answer_type.title}}</option>
        </select>

        <div v-if="errors.has('answers_type')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('answers_type') }}
        </div>
    </div>
</div>

<hr>
<div class="form-group row align-items-center">
    <div class="col-2"></div>
    <div class="col-lg-8">
        <answers-form :type="form.answers_type" :config="mediaWysiwygConfig" v-model="form.answers">
        </answers-form>
    </div>
</div>
<hr>


<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('explanation'), 'has-success': fields.explanation && fields.explanation.valid }">
    <label for="explanation" class="col-form-label text-md-right"
           :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Пояснение для правильного ответа</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.explanation" id="explanation" name="explanation"
                     :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('explanation')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('explanation') }}
        </div>
    </div>
</div>

<div class="form-check row"
     :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.test.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}
        </div>
    </div>
</div>