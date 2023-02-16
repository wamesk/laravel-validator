<?php

namespace Wame\Validator\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\DB;

class Exists implements InvokableRule
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = new $model;
    }

    public function __invoke($attribute, $value, $fail)
    {
        $softDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive(get_class($this->model)), true);
        $entity = match ($softDeletes) {
            true => $this->model->select('id', 'deleted_at')->withTrashed()->where([$attribute => $value])->first(),
            false => $this->model->select('id')->where([$attribute => $value])->first(),
        };

        if (!$entity) {
            $fail(__('wame-validation.exists'));
        }
        else if ($entity?->deleted_at) {
            $fail(__('wame-validation.soft_deleted'));
        }
    }
}
