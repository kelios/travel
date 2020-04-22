<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreTravel extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'budget' => ['nullable', 'integer'],
            'year' => ['nullable', 'integer'],
            'number_peoples' => ['nullable', 'integer'],
            'number_days' => ['nullable', 'integer'],
            'minus' => ['nullable', 'string'],
            'plus' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'publish' => ['nullable', 'boolean'],
            'visa' => ['nullable', 'boolean'],

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
