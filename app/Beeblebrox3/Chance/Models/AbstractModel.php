<?php

namespace Beeblebrox3\Chance\Models;

abstract class AbstractModel extends \Eloquent
{
    protected $softDelete = true;

    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function errors()
    {
        return $this->errors;
    }
}
