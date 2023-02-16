<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class Exists implements InvokableRule
{
    public function __construct(protected $model, protected $column = null) {}

    public function __invoke($attribute, $value, $fail)
    {
        $softDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this->model), true);
        $model = new $this->model;
        $column = $this->column ?? $attribute;
        
        $entity = match ($softDeletes) {
            true => $model->select('id', 'deleted_at')->withTrashed()->where([$column => $value])->first(),
            false => $model->select('id')->where([$column => $value])->first(),
        };

        if (!$entity) {
            $fail(__('wame-validation.exists'));
        }
        else if ($entity?->deleted_at) {
            $fail(__('wame-validation.soft_deleted'));
        }
    }
}
