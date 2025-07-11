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
        'name' => ['required', 'string', 'max:255'],
        'is_singleday' => ['required', 'boolean'],
        'date' => ['nullable', 'date'],
        'start_date' => ['nullable', 'date'],
        'end_date' => ['nullable', 'date', 'after:start_date'],
        'event_type' => [
            'required',
            Rule::in(array_column(EventType::cases(), 'value'))
        ],
        'event_scope' => [
            'required',
            Rule::in(array_column(EventScope::cases(), 'value'))
        ],
        'event_category_id' => [
            'required',
            Rule::exists('event_categories', 'id')->whereNull('deleted_at'),
        ],
    ];
}

public function withValidator($validator)
{
    $validator->sometimes('date', 'required', function ($input) {
        return $input->is_singleday === true || $input->is_singleday === '1';
    });

    $validator->sometimes(['start_date', 'end_date'], 'required', function ($input) {
        return $input->is_singleday === false || $input->is_singleday === '0';
    });
}


}


