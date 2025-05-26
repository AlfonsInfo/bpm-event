<?php

namespace App\Http\Requests;

use App\Enums\EventScope;
use App\Enums\EventType;
use Illuminate\Validation\Rule;


class EventRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'max:255'],
            "start_date" => ['required', 'date'],
            "end_date" => ['required', 'date', 'after:start_date'],
            "event_type" => ['required', Rule::in(array_column(EventType::cases(), 'value'))],
            "event_scope" => ['required', Rule::in(array_column(EventScope::cases(), 'value'))],
            "event_category_id" => ['required',Rule::exists('event_categories', 'id')->whereNull('deleted_at'),],
        ];    
    }

}


