<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['nullable', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($this->user->getKey(), $this->user->getKeyName()), 'string'],
            'password' => ['sometimes', 'confirmed', 'min:7', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/', 'string'],
        ];

        return $rules;
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getModifiedData(): array
    {
        $sanitized = $this->validated();
       // $data = collect($this->rules())->keys()->all();
        if (array_key_exists('password', $sanitized) && empty($sanitized['password'])) {
            unset($sanitized['password']);
        }
        if (!empty($sanitized['password'])) {
            $sanitized['password'] = Hash::make($sanitized['password']);
        }
        return $sanitized;
    }
}
