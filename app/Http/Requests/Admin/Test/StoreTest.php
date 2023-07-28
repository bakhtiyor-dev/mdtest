<?php

namespace App\Http\Requests\Admin\Test;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreTest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.test.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'body' => ['required', 'string'],
            'answers_type' => ['required'],
            'answers' => ['required'],
            'explanation' => ['sometimes'],
            'status' => ['required', 'boolean']
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
