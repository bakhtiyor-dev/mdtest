<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function available()
    {
        return view('client.exams.available.index', [
            'exams' => auth()->user()
                ->exams()
                ->with(['department', 'organisation'])
                ->available()
                ->orderBy('start_date', 'desc')
                ->paginate(6)
        ]);
    }

    public function expired()
    {
        return view('client.exams.expired.index', [
            'exams' => auth()->user()
                ->exams()
                ->with(['department', 'organisation'])
                ->expired()
                ->orderBy('end_date', 'desc')
                ->paginate(6)
        ]);
    }

}