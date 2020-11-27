<?php

namespace App\Http\Requests\Travel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class IndexTravel extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'orderBy' => 'in:id,name,budget,number_peoples,number_days,publish,visa,sitemap,moderation|nullable',
            'orderDirection' => 'in:asc,desc|nullable',
            'search' => 'string|nullable',
            'page' => 'integer|nullable',
            'per_page' => 'integer|nullable',

        ];
    }
}
