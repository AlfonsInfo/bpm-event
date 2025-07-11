<?php

namespace App\Http\Requests;

use App\Enums\EventScope;
use App\Enums\EventType;
use Illuminate\Validation\Rule;


class GroupCellHasMemberRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            "user_ids" => ['required', 'array'],
        ];    
    }

}


