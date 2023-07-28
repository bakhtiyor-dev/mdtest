
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': fields.title && fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'"><?php echo e(trans('admin.rating-setting.columns.title')); ?></label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" data-vv-as="название" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': fields.title && fields.title.valid}" id="title" name="title" placeholder="<?php echo e(trans('admin.rating-setting.columns.title')); ?>">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-2"></div>
    <div class="col-8">
        <rating-settings v-model="form.settings"></rating-settings>
    </div>
</div>


<?php /**PATH C:\OpenServer\domains\mdtesting\resources\views/admin/rating-setting/components/form-elements.blade.php ENDPATH**/ ?>