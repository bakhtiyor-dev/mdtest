<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Exam;
use App\Models\Organisation;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = Department::all();
        $organisations = Organisation::all();

        Exam::factory(100)->create([
            'department_id' => $departments->random()->id,
            'organisation_id' => $organisations->random()->id
        ]);
    }
}
