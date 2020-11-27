<?php

namespace App\Http\Requests\Admin\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTravel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.travel.edit', $this->travel);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'budget' => ['nullable', 'integer'],
            'number_peoples' => ['nullable', 'integer'],
            'number_days' => ['nullable', 'integer'],
            'minus' => ['nullable', 'string'],
            'plus' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'publish' => ['nullable', 'boolean'],
            'moderation' => ['nullable', 'boolean'],
            'sitemap' => ['nullable', 'boolean'],
            'visa' => ['nullable', 'boolean'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],

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
