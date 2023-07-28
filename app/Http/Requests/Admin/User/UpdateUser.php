<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.user.edit', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //'username' => ['sometimes', Rule::unique('users', 'username')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'password' => $this->password ? ['sometimes', 'confirmed', 'min:7', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/', 'string']: '',
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'fullname' => ['sometimes', 'string'],
            'position' => ['sometimes'],
            'department' => ['sometimes'],
            'organisation' => ['sometimes'],
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
