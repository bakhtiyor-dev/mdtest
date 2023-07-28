<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamUserAttempt;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExamUserAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exams = Exam::with(['department', 'organisation', 'ratingSettings'])->get();
        $users = User::take(100)->get();

        ExamUserAttempt::factory(1000)->create([
            'exam' => $exams->random()->toArray(),
            'user' => $users->random()->toArray()
        ]);
    }
}
