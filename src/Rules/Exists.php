<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class Exists implements InvokableRule
{
    protected $model;

    public function __construct($model)
    {
        $this->model = new $model;
    }

    public function __invoke($attribute, $value, $fail)
    {
        if ($this->model->withTrashed()->where([$attribute => $value])->count() === 0) {
            $fail(__('wame-validation.exists'));
        }
        else if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(get_class($this->model)), true) && $this->model->where([$attribute => $value])->count() === 0) {
            $fail(__('wame-validation.soft_deleted'));
        }
    }
}
