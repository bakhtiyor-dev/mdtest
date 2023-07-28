<?php

namespace App\Http\Requests\Admin\ExamUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateExamUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.exam-user.edit', $this->examUser);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', Rule::unique('exam_user', 'user_id')->ignore($this->examUser->getKey(), $this->examUser->getKeyName()), 'string'],
            'exam_id' => ['nullable', Rule::unique('exam_user', 'exam_id')->ignore($this->examUser->getKey(), $this->examUser->getKeyName()), 'string'],
            
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
