<?php

namespace App\Http\Requests\Admin\Exam;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreExam extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.exam.create');
    }

    /**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return array
     */
    public function untranslatableRules(): array
    {
        return [
            'organisation_id' => ['required', 'integer'],
            'department_id' => ['required', 'integer'],
            'title' => ['required', Rule::unique('exams', 'title'), 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'time' => ['required', 'integer'],
            'attempts_count' => ['required', 'integer'],
            'rating_setting_id' => ['required', 'integer'],
            'can_complete_untill_all_answered' => ['required', 'boolean'],
            'can_return_to_passed_question' => ['required', 'boolean'],
            'can_skip_question' => ['required', 'boolean'],
            'enable_explanation' => ['required', 'boolean'],
            'test_category_count' => ['required'],
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
