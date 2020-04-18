<?php

namespace App\Http\Requests\Admin\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreTravel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.travel.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'budget' => ['nullable', 'integer'],
            'number_peoples' => ['nullable', 'integer'],
            'number_days' => ['nullable', 'integer'],
            'minus' => ['required', 'string'],
            'plus' => ['required', 'string'],
            'recommendation' => ['required', 'string'],
            'description' => ['required', 'string'],
            'publish' => ['required', 'boolean'],
            'visa' => ['required', 'boolean'],
            
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
