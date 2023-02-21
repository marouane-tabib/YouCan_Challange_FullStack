<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Validator;

trait CliValidator
{
    public function validateInput(string $attribute, string $validation, $value)
    {
        if (! is_array($value) && ! is_bool($value) && 0 === strlen($value)) {
            throw new Exception('A value is required.');
        }

        $validator = Validator::make([
            $attribute => $value
        ], [
            $attribute => $validation
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->first($attribute));
        }

        return $value;
    }
}
