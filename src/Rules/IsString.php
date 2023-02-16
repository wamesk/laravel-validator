<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class IsString implements InvokableRule
{
    public function __construct(protected $min = null, protected $max = null) {}

    public function __invoke($attribute, $value, $fail)
    {
        if (gettype($value) !== 'string') {
            $fail(__('wame-validation.string'));
        }
        if (strlen($value) < $this->min && isset($this->min)) {
            $fail(__('wame-validation.min.string', ['min' => $this->min]));
        }
        if (strlen($value) > $this->max && isset($this->max)) {
            $fail(__('wame-validation.max.string', ['max' => $this->max]));
        }
    }
}
