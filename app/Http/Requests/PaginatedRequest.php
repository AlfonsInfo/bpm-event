<?php

namespace App\Http\Requests;


class PaginatedRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            "page"     => ['integer', 'min:1'],
            "per_page" => ['integer', 'min:1'],
        ];       
    }

}


