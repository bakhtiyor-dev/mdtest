<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\ExamUserAttempt;
use App\Models\Organisation;
use App\Models\Department;
use App\Models\Test;
use App\Models\TestCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Organisation::factory(10)->create();
        Department::factory(10)->create();
        TestCategory::factory(10)->create();
    }
}
