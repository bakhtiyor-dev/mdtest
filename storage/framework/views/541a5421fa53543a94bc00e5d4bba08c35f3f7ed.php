

<?php $__env->startSection('title', 'Аналитика'); ?>

<?php $__env->startSection('body'); ?>

    <analytics :initial-data="<?php echo e(json_encode($data)); ?>"
               inline-template
               v-cloak>
        <div>
            <div class="row mb-3">
                <h4 class="col-lg">
                    <i class="fa fa-line-chart"></i>
                    Аналитика
                </h4>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body report report-warning">
                            <div>
                                <h2>{{data['departments_count']}}</h2>
                                <h5>Отделов</h5>
                            </div>

                            <h1 class="text-warning"><i class="fa fa-cubes"></i></h1>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-3">
                    <div class="card">
                        <div class="card-body report report-primary">
                            <div>
                                <h2>{{data['users_count']}}</h2>
                                <h5>Пользователей</h5>
                            </div>

                            <h1 class="text-primary"><i class="fa fa-users"></i></h1>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-3">
                    <div class="card">
                        <div class="card-body report report-danger ">
                            <div>
                                <h2>{{data['exams_count']}}</h2>
                                <h5>Экзаменов</h5>
                            </div>
                            <h1 class="text-danger"><i class="fa fa-calendar"></i></h1>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-3">
                    <div class="card">
                        <div class="card-body report report-success">
                            <div>
                                <h2>{{data['tests_count']}}</h2>
                                <h5>Тестов</h5>
                            </div>
                            <h1 class="text-success"><i class="fa fa-list-alt"></i></h1>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col col-lg-5">
                    <div class="card">
                        <div class="card-body report-warning">
                            <h4 class="mb-4">Аналитика по результатам:</h4>
                            <div class="row mb-4">
                                <div class="col-lg">
                                    <h2>{{data['finished_attempts_count']}}</h2>
                                    <h5>Завершенных попыток </h5>
                                </div>

                                <div class="col-lg-7">
                                    <label>Фильтр по экзаменам (по умолчанию все):</label>

                                    <v-select :options="<?php echo e($exams->toJson()); ?>"
                                              label="title"
                                              :reduce="function(exam){ return exam.id}"
                                              @input="filter('exam',$event)">
                                    </v-select>
                                </div>


                            </div>

                            <doughnut-chart v-if="attemptStatsData.datasets[0].data.length"
                                            :chart-data="attemptStatsData">
                            </doughnut-chart>

                            <div v-else>
                                <p class="text-muted text-center">Отсутсвует пройденных тестов!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-7">

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-lg">
                                    <h4>Аналитика по тестам (вопросам):</h4>
                                </div>
                                <div class="col-lg">
                                    <label>Фильтр по категориям (по умолчанию все):</label>

                                    <v-select :options="<?php echo e($testCategories->toJson()); ?>"
                                              label="title"
                                              :reduce="function(category) {return category.id}"
                                              @input="filter('category',$event)">
                                    </v-select>
                                </div>
                            </div>


                            <bar-chart v-if="testStatsData.datasets[0].data.length" :chart-data="testStatsData">
                            </bar-chart>
                            <div v-else>
                                <p class="text-muted text-center">Отсутсвует тестов!</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </analytics>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('brackets/admin-ui::admin.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\myproject\resources\views/admin/analytics/index.blade.php ENDPATH**/ ?>