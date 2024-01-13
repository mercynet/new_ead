<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Nnjeim\World\WorldHelper;
use Respect\Validation\Validator as v;

class PostalCode implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function __construct()
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $postalCodeSanitized = justNumbers($value);
        if (! v::postalCode('BR')->validate($postalCodeSanitized)) {
            $fail(__('addresses.postal_code.validation.invalid_number'));
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
