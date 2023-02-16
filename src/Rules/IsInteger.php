<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class IsInteger implements InvokableRule
{
    public function __construct(protected $min = null, protected $max = null) {}

    public function __invoke($attribute, $value, $fail)
    {
        if (!is_numeric($value)) {
            $fail(__('wame-validation.integer'));
        }
        if ((int) $value < $this->min && isset($this->min)) {
            $fail(__('wame-validation.min.numeric', ['min' => $this->min]));
        }
        if ((int) $value > $this->max && isset($this->max)) {
            $fail(__('wame-validation.max.numeric', ['max' => $this->max]));
        }
    }
}
