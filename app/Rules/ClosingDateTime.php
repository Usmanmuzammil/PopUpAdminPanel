<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ClosingDateTime implements Rule
{
    public function passes($attribute, $value)
    {
        $openingTime = request()->input('opening_time');
        $closingDateTime = request()->input('closing_date') . ' ' . $value;

        // Check if closing_datetime is greater than opening_datetime
        return strtotime($closingDateTime) >= strtotime(now()->format('H:i:s'));
    }

    public function message()
    {
        return 'The :attribute must be a date and time after the current time.';
    }
}
