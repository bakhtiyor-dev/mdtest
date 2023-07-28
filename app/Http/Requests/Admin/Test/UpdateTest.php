<?php

namespace App\Http\Requests\Admin\Test;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.test.edit', $this->test);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => ['sometimes'],
            'body' => ['sometimes', 'string'],
            'answers_type' => ['sometimes', 'string'],
            'answers' => ['sometimes'],
            'explanation' => ['sometimes'],
            'status' => ['sometimes', 'boolean']
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

    public function getAnswersType()
    {
        if ($this->has('answers_type')) {
            return $this->get('answers_type');
        }
        return null;
    }

    public function getAnswersData()
    {
        if ($this->has('answers')) {
            return $this->get('answers')['data'];
        }
        return null;
    }
}
