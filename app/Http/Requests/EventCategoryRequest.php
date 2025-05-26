<?php

namespace App\Http\Requests;

use App\Enums\EventScope;
use App\Enums\EventType;
use Illuminate\Validation\Rule;


class EventCategoryRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'max:255'],            
            "description" => ['required', 'string', 'max:255'],
        ];    
    }

}


