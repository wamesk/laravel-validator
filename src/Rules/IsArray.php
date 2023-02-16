<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class IsArray implements InvokableRule
{
    public function __construct(protected $min = null, protected $max = null) {}

    public function __invoke($attribute, $value, $fail)
    {
        if (gettype($value) !== 'array') {
            $fail(__('wame-validation.array'));
        }
        if (count($value) < $this->min && isset($this->min)) {
            $fail(__('wame-validation.min.array', ['min' => $this->min]));
        }
        if (count($value) > $this->max && isset($this->max)) {
            $fail(__('wame-validation.max.array', ['max' => $this->max]));
        }
    }
}
