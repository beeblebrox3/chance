<?php

namespace Beeblebrox3\Chance\Models\Observers;

use Illuminate\Validation\Factory;

abstract class AbstractObserver
{
    /**
     * The Validator instance
     *
     * @var Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [];

    /**
     * Error messages
     * @var mixed
     */
    protected $errors = null;

    /**
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate $data against $rules
     * @param  array  $data  data to be validated
     * @param  array  $rules validation rules
     * @return boolean
     */
    protected function passes(array $data, array $rules)
    {
        $validator = $this->validator->make($data, $rules);
        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();
        return false;
    }

    /**
     * Update unique rules adding the current $id to the exclusion list
     * @param  array  $rules
     * @return array  modified $rules
     */
    protected function updateUniques(array $rules)
    {
        $data = $this->data;
        foreach ($rules as $field => $rule) {
            $rules[$field] = preg_replace(
                "/unique\:([a-z_]+)/i",
                'unique:$1,' . $field . ',' . $data['id'],
                $rule
            );
        }

        return $rules;
    }

    /**
     * Do stuff before validate the data
     * @param Eloquent $model
     * @return Eloquent
     */
    protected function filter(\Eloquent $model)
    {
        return $model;
    }

    /**
     * Before create new record
     * @param \Eloquent $model
     * @return bool
     */
    public function creating(\Eloquent $model)
    {
        if (\Auth::check() && $model->isFillable('author_id')) {
            $model->author_id = \Auth::user()->id;
        }

        $model = $this->filter($model);

        $this->data = $model->getAttributes();

        if ($this->passes($this->data, $this->rules)) {
            return true;
        }

        $model->setErrors($this->errors);
        \Log::error(
            '[CREATING] Error validating '. get_class($this),
            ['errors' => $this->errors->toArray(), 'data' => $model->getAttributes()]
        );
        return false;
    }

    /**
     * Before update new record
     * @param \Eloquent $model
     * @return bool
     */
    public function updating(\Eloquent $model)
    {
        $model = $this->filter($model);
        $this->data = $model->getAttributes();

        $rules = $this->updateUniques($this->rules);

        if ($this->passes($this->data, $rules)) {
            return true;
        }

        $model->setErrors($this->errors);
        \Log::error(
            '[UPDATING] Error validating '. get_class($this),
            ['errors' => $this->errors->toArray(), 'data' => $model->getAttributes()]
        );
        return false;
    }
}
