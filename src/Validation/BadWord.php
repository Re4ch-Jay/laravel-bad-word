<?php

namespace Patoui\LaravelBadWord\Validation;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BadWord
{
    /**
     * Validates for bad words.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @param  array  $parameters
     * @param  object $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        if (!is_string($value)) {
            return true;
        }

        // Get the list of bad words from the config
        $words = config('bad-word.badwords', []);

        // If parameters are specified, filter the words accordingly
        if (count($parameters) > 0) {
            $words = Arr::only($words, $parameters);
        }

        // Flatten the array and check if the value contains any bad words
        return !Str::contains(strtolower($value), Arr::flatten($words));
    }
}
