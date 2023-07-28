<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\Exam;
use App\Models\ExamUser;
use Illuminate\Http\Request;

class NotifyUserController extends Controller
{
    public function __invoke(Request $request, Exam $exam)
    {
        $request->validate(['bulkItems' => 'required']);

        $ids = pluck_bulk_items($request->json('bulkItems'));

        $examUsers = ExamUser::whereIn('id', $ids)->get();

        foreach ($examUsers as $examUser) {
            $response = $examUser->notify();

            if (!$response['success'])
                return $response;
        }

        return ['success' => true, 'message' => 'Успешно'];

    }

}
