<?php

namespace App\Http\Requests\Admin\Exam;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateExam extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.exam.edit', $this->exam);
    }

    /**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return array
     */
    public function untranslatableRules(): array
    {
        return [
            'organisation_id' => ['sometimes', 'integer'],
            'department_id' => ['sometimes', 'integer'],
            'title' => ['sometimes', Rule::unique('exams', 'title')->ignore($this->exam->getKey(), $this->exam->getKeyName()), 'string'],
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'date'],
            'time' => ['sometimes', 'integer'],
            'attempts_count' => ['sometimes', 'integer'],
            'rating_setting_id' => ['sometimes', 'integer'],
            'can_complete_untill_all_answered' => ['sometimes', 'boolean'],
            'can_return_to_passed_question' => ['sometimes', 'boolean'],
            'can_skip_question' => ['sometimes', 'boolean'],
            'enable_explanation' => ['sometimes', 'boolean'],
            'test_category_count' => ['sometimes'],
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
