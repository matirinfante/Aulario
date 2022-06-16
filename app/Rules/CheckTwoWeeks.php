<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class CheckTwoWeeks implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        return $date->lessThanOrEqualTo(Carbon::parse(Carbon::today())->addWeeks(2));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Las reservas no pueden superar las dos semanas de anticipación. Se puede reservar hasta el ' . Carbon::parse(Carbon::today())->addWeeks(2)->format('d-m-Y');
    }
}
