<?php

namespace Beeblebrox3\Chance\Controllers;

abstract class AbstractController extends \Controller
{
    protected $model = null;

    /**
     * Get a model instance
     * @return Eloquent
     */
    public function model()
    {
        if ($this->model) {
            $model = $this->model;
            return new $model;
        }

        return null;
    }
}
